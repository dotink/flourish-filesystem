<?php namespace Dotink\Flourish {

	/**
	 * Represents a directory on the filesystem, also provides static directory-related methods
	 *
	 * @copyright  Copyright (c) 2007-2011 Will Bond, others
	 * @author     Will Bond [wb] <will@flourishlib.com>
	 * @author     Will Bond, iMarc LLC [wb-imarc] <will@imarc.net>
	 * @author     Matthew J. Sahagian [mjs] <msahagian@dotink.org>
	 *
	 * @license    Please see the LICENSE file at the root of this distribution
	 *
	 * @package    Flourish
	 */

	class Directory
	{
		/**
		 * A backtrace from when the file was deleted
		 *
		 * @var array
		 */
		protected $deleted = NULL;


		/**
		 * The full path to the directory
		 *
		 * @var string
		 */
		protected $directory;


		/**
		 * Whether or not the file exists
		 *
		 */
		protected $exists = FALSE;


		/**
		 * Makes sure a directory has a `/` or `\` at the end
		 *
		 * @param string $directory The directory to check
		 * @return string The directory name in canonical form
		 */
		static public function makeCanonical($directory)
		{
			$directory  = rtrim($directory, '/\\' . DIRECTORY_SEPARATOR);
			$directory .= DIRECTORY_SEPARATOR;

			return $directory;
		}


		/**
		 * Creates an object to represent a directory on the filesystem
		 *
		 * If multiple Directory objects are created for a single directory, they will reflect
		 * changes in each other including rename and delete actions.
		 *
		 * @throws ValidationException  When no directory was specified or path is not a directory
		 *
		 * @param string $directory The path to the directory
		 * @param boolean $skip_checks If file checks should be skipped
		 * @return void
		 */
		public function __construct($directory, $skip_checks=FALSE)
		{
			if (!$skip_checks) {
				if (empty($directory)) {
					throw new ValidationException('No directory was specified');
				}

				if (is_file($directory)) {
					throw new ValidationException(
						'The directory specified, %s, is not a directory',
						$directory
					);
				}
			}

			$directory       =  self::makeCanonical(Filesystem::normalizePath($directory));
			$this->directory =& Filesystem::hookFilenameMap($directory);
			$this->deleted   =& Filesystem::hookDeletedMap($directory);
			$this->exists    =& Filesystem::hookExistsMap($directory);

			//
			// If the directory is listed as deleted and we are not inside a transaction, but
			// we've gotten to here, then the directory exists, so we can wipe the backtrace
			//

			if ($this->deleted !== NULL && !Filesystem::isInsideTransaction()) {
				Filesystem::updateDeletedMap($directory, NULL);
			}
		}


		/**
		 * Returns the full filesystem path for the directory
		 *
		 * @return string The full filesystem path
		 */
		public function __toString()
		{
			return $this->getPath();
		}


		/**
		 * Removes all files and directories inside of the directory
		 *
		 * @return void
		 */
		public function clear()
		{
			if ($this->deleted || !$this->exists) {
				return;
			}

			foreach ($this->scan() as $file) {
				$file->delete();
			}
		}


		/**
		 * Creates the directory on the filesystem
		 *
		 * The directory creation is done recursively, so if any of the parent
		 * directories do not exist, they will be created.
		 *
		 * This operation will be reverted by a filesystem transaction being rolled back.
		 *
		 * @param numeric $mode The mode (permissions) to use when creating the directory.
		 * @return Directory The Directory object for method chaining
		 */
		public function create($mode=0777)
		{
			if (!$this->exists()) {
				$parent = $this->getParent();

				if (!$parent->exists()) {
					$parent->create($mode);
				}

				if (!$parent->isWritable()) {
					throw new EnvironmentException(
						'The directory, "%s", could not be created; parent is not writable',
						$this->directory
					);
				}

				if (!mkdir($this->directory, $mode)) {
					throw new EnvironmentException(
						'The directory, "%s", could not be created; unknown error',
						$this->directory
					);
				}

				$this->exists = TRUE;

				Filesystem::recordCreate($this);
			}

			return $this;
		}


		/**
		 * Will delete a directory and all files and directories inside of it
		 *
		 * This operation will not be performed until the filesystem transaction has been
		 * committed, if a transaction is in progress. Any non-Flourish code (PHP or system) will
		 * still see this directory and all contents as existing until that point.
		 *
		 * @return void
		 */
		public function delete()
		{
			if ($this->deleted || !$this->exists) {
				return;
			}

			if (!$this->getParent()->isWritable()) {
				throw new EnvironmentException(
					'The directory, %s, cannot be deleted; parent directory is not writable',
					$this->directory
				);
			}

			$files = $this->scan();

			foreach ($files as $file) {
				$file->delete();
			}

			if (Filesystem::isInsideTransaction()) {
				return Filesystem::recordDelete($this);
			}

			if (rmdir($this->directory)) {
				$this->exists = FALSE;

			} else {
				throw new EnvironmentException(
					'The directory, "%s", could not be deleted; unknown error',
					$this->directory
				);
			}

			Filesystem::updateDeletedMap($this->directory, debug_backtrace());
			Filesystem::updateFilenameMapForDirectory($this->directory, sprintf(
				'*DELETED at %d with token %s* %s', time(), uniqueid('', TRUE),	$this->directory
			));
		}


		/**
		 * Gets whether or not the directory exists
		 *
		 * @return boolean TRUE if the directory exists, FALSE otherwise
		 */
		public function exists()
		{
			return $this->exists;
		}


		/**
		 * Gets the name of the directory
		 *
		 * @return string The name of the directory
		 */
		public function getName()
		{
			return Filesystem::getPathInfo($this->directory, 'basename');
		}


		/**
		 * Gets the parent directory
		 *
		 * @return Directory The object representing the parent directory
		 */
		public function getParent()
		{
			$this->tossIfDeleted();

			$dirname = Filesystem::getPathInfo($this->directory, 'dirname');

			if ($dirname == $this->directory) {
				throw new EnvironmentException(
					'The current directory does not have a parent directory'
				);
			}

			return new Directory($dirname);
		}


		/**
		 * Gets the directory's current path
		 *
		 * If the web path is requested, uses translations set with
		 * Filesystem::addWebPathTranslation()
		 *
		 * @param boolean $translate_to_web_path If the path should be the web path
		 * @return string The path for the directory
		 */
		public function getPath($translate_to_web_path=FALSE)
		{
			$this->tossIfDeleted();

			if ($translate_to_web_path) {
				return Filesystem::translateToWebPath($this->directory);
			}

			return $this->directory;
		}


		/**
		 * Gets the disk usage of the directory and all files and folders contained within
		 *
		 * This method may return incorrect results if files over 2GB exist and the server uses a
		 * 32 bit operating system
		 *
		 * @param boolean $format If the filesize should be formatted for human readability
		 * @param integer $decimal_places The number of decimal places to format to (if enabled)
		 * @return integer The filesize in bytes
		 * @return string If formatted a string with filesize in b/kb/mb/gb/tb
		 */
		public function getSize($format=FALSE, $decimal_places=1)
		{
			$this->tossIfDeleted();

			$size = 0;

			if ($this->exists) {
				$children = $this->scan();

				foreach ($children as $child) {
					$size += $child->getSize();
				}
			}

			if (!$format) {
				return $size;
			}

			return Filesystem::formatFilesize($size, $decimal_places);
		}


		/**
		 * Check to see if the current directory is writable
		 *
		 * @return boolean If the directory is writable
		 */
		public function isWritable()
		{
			$this->tossIfDeleted();

			$directory = $this;

			while (!$directory->exists) {
				$directory = $directory->getParent();
			}

			return is_writable($directory->directory);
		}


		/**
		 * Moves the current directory into a different directory
		 *
		 * Please note that ::rename() will rename a directory in its current parent directory or
		 * rename it into a different parent directory.
		 *
		 * If the current directory's name already exists in the new parent directory and the
		 * overwrite flag is set to false, the name will be changed to a unique name.
		 *
		 * This operation will be reverted if a filesystem transaction is in progress and is later
		 * rolled back.
		 *
		 * @throws ValidationException When the new parent directory is invalid
		 *
		 * @param Directory|string $new_parent_directory The new parent directory
		 * @param boolean $overwrite Whether to overwrite a any destination with the same name
		 * @return Directory The directory object, to allow for method chaining
		 */
		public function move($new_parent_directory, $overwrite)
		{
			if (!$new_parent_directory instanceof Directory) {
				$new_parent_directory = new self($new_parent_directory);
			}

			if (strpos($new_parent_directory->getPath(), $this->getPath()) === 0) {
				throw new ValidationException(
					'It is not possible to move a directory into one of its sub-directories'
				);
			}

			return $this->rename($new_parent_directory->getPath() . $this->getName(), $overwrite);
		}


		/**
		 * Renames the current directory
		 *
		 * This operation will NOT be performed until the filesystem transaction has been
		 * committed, if a transaction is in progress. Any non-Flourish code (PHP or system) will
		 * still see this directory (and all contained files/dirs) as existing with the old paths
		 * until that point.
		 *
		 * @param string $new_dirname The new directory name
		 * @param boolean $overwrite Whether to overwrite a any destination with the same name
		 * @return void
		 */
		public function rename($new_dirname, $overwrite)
		{
			$this->tossIfDeleted();

			if (!$this->getParent()->isWritable()) {
				throw new EnvironmentException(
					'The directory, "%s", cannot be renamed; parent directory is not writable',
					$this->directory
				);
			}

			//
			// If the dirname does not contain any folder traversal, rename the dir in the current
			// parent directory
			//

			if (preg_match('#^[^/\\\\]+$#D', $new_dirname)) {
				$new_dirname = $this->getParent()->getPath() . $new_dirname;
			}

			$info = fFilesystem::getPathInfo($new_dirname);

			if (!file_exists($info['dirname'])) {
				throw new fProgrammerException(
					'The directory specified, %s, is inside a directory that does not exist',
					$new_dirname
				);
			}

			if (file_exists($new_dirname)) {
				if (!is_writable($new_dirname)) {
					throw new fEnvironmentException(
						'The directory specified, %s, already exists, but is not writable',
						$new_dirname
					);
				}

				if (!$overwrite) {
					$new_dirname = fFilesystem::makeUniqueName($new_dirname);
				}

			} else {
				$parent_dir = new fDirectory($info['dirname']);
				if (!$parent_dir->isWritable()) {
					throw new fEnvironmentException(
						'The directory specified, %s, is inside a directory that is not writable',
						$new_dirname
					);
				}
			}

			rename($this->directory, $new_dirname);

			$new_dirname = self::makeCanonical(realpath($new_dirname));

			if (Filesystem::isInsideTransaction()) {
				Filesystem::rename($this->directory, $new_dirname);
			}

			fFilesystem::updateFilenameMapForDirectory($this->directory, $new_dirname);
		}


		/**
		 * Performs a scandir() on a directory, removing the `.` and `..` entries
		 *
		 * If the `$filter` looks like a valid PCRE pattern - matching delimeters (a delimeter can
		 * be any non-alphanumeric, non-backslash, non-whitespace character) followed by zero or
		 * more of the flags `i`, `m`, `s`, `x`, `e`, `A`, `D`,  `S`, `U`, `X`, `J`, `u` - then
		 * [http://php.net/preg_match `preg_match()`] will be used.
		 *
		 * Otherwise the `$filter` will do a case-sensitive match with `*` matching zero or more
		 * characters and `?` matching a single character.
		 *
		 * On all OSes (even Windows), directories will be separated by `/`s when comparing with
		 * the `$filter`.
		 *
		 * @param string $filter A PCRE or glob pattern to filter files/directories by path
		 * @return array The File (or Image) and Directory objects for the child files/directories
		 */
		public function scan($filter=NULL)
		{
			$this->tossIfDeleted();

			if (!$this->exists) {
				return array();
			}

			$files   = array_diff(scandir($this->directory), ['.', '..']);
			$objects = array();

			if ($filter && !preg_match('#^([^a-zA-Z0-9\\\\\s]).*\1[imsxeADSUXJu]*$#D', $filter)) {
				$filter = '#^' . strtr(
					preg_quote($filter, '#'),
					array(
						'\\*' => '.*',
						'\\?' => '.'
					)
				) . '$#D';
			}

			natcasesort($files);

			foreach ($files as $file) {
				if ($filter) {
					$test_path = (is_dir($this->directory . $file)) ? $file . '/' : $file;
					if (!preg_match($filter, $test_path)) {
						continue;
					}
				}

				$objects[] = Filesystem::createObject($this->directory . $file);
			}

			return $objects;
		}


		/**
		 * Performs a **recursive** scandir() on a directory, removing the `.` and `..` entries
		 *
		 * @param string $filter A PCRE or glob pattern to filter files/directories by path
		 * @return array The File (or Image) and Directory objects for the child* files/directories
		 */
		public function scanRecursive($filter=NULL)
		{
			$this->tossIfDeleted();

			$objects = $this->scan();

			for ($i=0; $i < sizeof($objects); $i++) {
				if ($objects[$i] instanceof self) {
					array_splice($objects, $i+1, 0, $objects[$i]->scan());
				}
			}

			if ($filter) {
				if (!preg_match('#^([^a-zA-Z0-9\\\\\s*?^$]).*\1[imsxeADSUXJu]*$#D', $filter)) {
					$filter = '#^' . strtr(
						preg_quote($filter, '#'),
						array(
							'\\*' => '.*',
							'\\?' => '.'
						)
					) . '$#D';
				}

				$new_objects  = array();
				$strip_length = strlen($this->getPath());

				foreach ($objects as $object) {
					$test_path = substr($object->getPath(), $strip_length);
					$test_path = str_replace(DIRECTORY_SEPARATOR, '/', $test_path);

					if (!preg_match($filter, $test_path)) {
						continue;
					}

					$new_objects[] = $object;
				}

				$objects = $new_objects;
			}

			return $objects;
		}


		/**
		 * Throws an exception if the directory has been deleted
		 *
		 * @return void
		 */
		protected function tossIfDeleted()
		{
			if ($this->deleted) {
				throw new ProgrammerException(
					'Cannot perform requested action; the directory has been deleted' . "\n\n" .
					'Backtrace for Directory::delete() call: ' . "\n" .
					'%s',
					Core::backtrace(0, $this->deleted)
				);
			}
		}
	}
}
