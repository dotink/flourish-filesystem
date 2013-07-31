# Filesystem
## Handles filesystem-level tasks including filesystem transactions and the reference map to keep all fFile and fDirectory objects in sync

_Copyright (c) 2008-2010 Will Bond, others_.
_Please see the LICENSE file at the root of this distribution_

#### Namespace

`Dotink\Flourish`

#### Authors

<table>
	<thead>
		<th>Name</th>
		<th>Handle</th>
		<th>Email</th>
	</thead>
	<tbody>
	
		<tr>
			<td>
				Will Bond
			</td>
			<td>
				wb
			</td>
			<td>
				will@flourishlib.com
			</td>
		</tr>
	
		<tr>
			<td>
				Alex Leeds
			</td>
			<td>
				al
			</td>
			<td>
				alex@kingleeds.com
			</td>
		</tr>
	
		<tr>
			<td>
				Will Bond
			</td>
			<td>
				
			</td>
			<td>
				
			</td>
		</tr>
	
		<tr>
			<td>
				Matthew J. Sahagian
			</td>
			<td>
				mjs
			</td>
			<td>
				msahagian@dotink.org
			</td>
		</tr>
	
	</tbody>
</table>

## Properties
### Static Properties
#### <span style="color:#6a6e3d;">$commit_operations</span>

Stores the operations to perform when a commit occurs

#### <span style="color:#6a6e3d;">$deleted_map</span>

Maps deletion backtraces to all instances of a file or directory, providing consistency

#### <span style="color:#6a6e3d;">$exists_map</span>

Stores file and directory names by reference, allowing all object instances to be
updated at once

#### <span style="color:#6a6e3d;">$filename_map</span>

Stores file and directory names by reference, allowing all object instances to be
updated at once

#### <span style="color:#6a6e3d;">$rollback_operations</span>

Stores the operations to perform if a rollback occurs

#### <span style="color:#6a6e3d;">$web_path_translations</span>

Stores a list of search => replace strings for web path translations





## Methods
### Static Methods
<hr />

#### <span style="color:#3e6a6e;">addWebPathTranslation()</span>

Adds a directory to the web path translation list

##### Details

The web path conversion list is a list of directory paths that will be converted (from
the beginning of filesystem paths) when preparing a path for output into HTML.

By default the `$_SERVER['DOCUMENT_ROOT']` will be converted to a blank string, in
essence stripping it from filesystem paths.

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$search_path
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The path to look for
			</td>
		</tr>
					
		<tr>
			<td>
				$replace_path
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The path to replace with
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">begin()</span>

Starts a filesystem pseudo-transaction (call only when no transaction is in progress)

##### Details

Flourish filesystem transactions are NOT full ACID-compliant transactions, but rather
more of an filesystem undo buffer which can return the filesystem to the state when
::begin() was called. If your PHP script dies in the middle of an operation this
functionality will do nothing for you and all operations will be retained, except for
deletes which only occur once the transaction is committed.

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">commit()</span>

Commits a filesystem transaction (call only when no transaction is in progress)

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">convertToBytes()</span>

Takes a file size including a unit of measure (i.e. kb, GB, M) and converts it to bytes

##### Details

Sizes are interpreted using base 2, not base 10. Sizes above 2GB may not
be accurately represented on 32 bit operating systems.

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$size
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The size to convert to bytes
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			integer
		</dt>
		<dd>
			The number of bytes represented by the size
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">createObject()</span>

Takes a filesystem path and creates either a Directory, File or Image object from it

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$path
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The path to the filesystem object
			</td>
		</tr>
			
	</tbody>
</table>

###### Throws

<dl>

	<dt>
					Dotink\Flourish\ValidationException		
	</dt>
	<dd>
		When no path was specified or the path specified does not exist
	</dd>

</dl>

###### Returns

<dl>
	
		<dt>
			Object
		</dt>
		<dd>
			A filesystem object (Directory, File, or Image if it exists)
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">formatFilesize()</span>

Takes the size of a file in bytes and returns a friendly size in B/K/M/G/T

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$bytes
			</td>
			<td>
									<a href="http://www.php.net/language.types.integer.php">integer</a>
				
			</td>
			<td>
				The size of the file in bytes
			</td>
		</tr>
					
		<tr>
			<td>
				$decimal_places
			</td>
			<td>
									<a href="http://www.php.net/language.types.integer.php">integer</a>
				
			</td>
			<td>
				The number of decimal places to display
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The filesize formatted in a friendly way (with suffix)
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getPathInfo()</span>

Returns info about a path including dirname, basename, extension and filename

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$path
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The file/directory path to retrieve information about
			</td>
		</tr>
					
		<tr>
			<td>
				$element
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The piece of information to return: `'dirname'`, `'basename'`, `'extension'`, or `'filename'`
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			array
		</dt>
		<dd>
			The file's dirname, basename, extension and filename
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">hookDeletedMap()</span>

Hooks a file/directory into the deleted backtrace map entry for that filename

##### Details

Since the value is returned by reference, all objects that represent this
file/directory always see the same backtrace.

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$file
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The name of the file or directory
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			mixed
		</dt>
		<dd>
			Will return `NULL` if no match, or the backtrace array if a match occurs
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">hookExistsMap()</span>

Hooks a file/directory into the exists map entry for that filename

##### Details

Since the value is returned by reference, all objects that represent this
file/directory will always be update on a rename.

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$file
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The name of the file or directory
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			mixed
		</dt>
		<dd>
			TRUE if the file exists and is readable, FALSE otherwise
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">hookFilenameMap()</span>

Hooks a file/directory name to the filename map

##### Details

Since the value is returned by reference, all objects that represent this
file/directory will always be update on a rename.

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$file
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The name of the file or directory
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			mixed
		</dt>
		<dd>
			Will return `NULL` if no match, or the exception object if a match occurs
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">isInsideTransaction()</span>

Indicates if a transaction is in progress

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">makeURLSafe()</span>

Changes a filename to be safe for URLs by making it all lower case and changing everything but letters, numers, - and . to _

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$filename
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The filename to clean up
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The cleaned up filename
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">makeUniqueName()</span>

Returns a unique name for a file

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$file
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The filename to check
			</td>
		</tr>
					
		<tr>
			<td>
				$new_extension
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The new extension for the filename, should not include `.`
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The unique file name
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">normalizePath()</span>


<hr />

#### <span style="color:#3e6a6e;">updateDeletedMap()</span>

Updates the deleted backtrace for a file or directory

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$file
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				A file or directory name, directories should end in `/` or `\`
			</td>
		</tr>
					
		<tr>
			<td>
				$backtrace
			</td>
			<td>
									<a href="http://www.php.net/language.types.array.php">array</a>
				
			</td>
			<td>
				The backtrace for this file/directory
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">updateFilenameMap()</span>

Updates the filename map, causing all objects representing a file/directory to be updated

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$existing_filename
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The existing filename
			</td>
		</tr>
					
		<tr>
			<td>
				$new_filename
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The new filename
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">updateFilenameMapForDirectory()</span>

Updates the filename map recursively, causing all objects representing a directory to be updated

##### Details

Also updates all files and directories in the specified directory to the new paths.

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$existing_dirname
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The existing directory name
			</td>
		</tr>
					
		<tr>
			<td>
				$new_dirname
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The new dirname
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">recordAppend()</span>

Stores what data has been added to a file so it can be removed if there is a rollback

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$file
			</td>
			<td>
									fFile				
			</td>
			<td>
				The file that is being written to
			</td>
		</tr>
					
		<tr>
			<td>
				$data
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The data being appended to the file
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">recordCreate()</span>

Keeps a record of created files so they can be deleted up in case of a rollback

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$object
			</td>
			<td>
									object				
			</td>
			<td>
				The new file or directory to get rid of on rollback
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">recordDelete()</span>

Keeps track of file and directory names to delete when a transaction is committed

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td rowspan="3">
				$object
			</td>
			<td>
									fFile				
			</td>
			<td rowspan="3">
				The filesystem object to delete
			</td>
		</tr>
			
		<tr>
			<td>
									fDirectory				
			</td>
		</tr>
						
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">recordDuplicate()</span>

Keeps a record of duplicated files so they can be cleaned up in case of a rollback

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$file
			</td>
			<td>
									fFile				
			</td>
			<td>
				The duplicate file to get rid of on rollback
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">recordRename()</span>

Keeps a temp file in place of the old filename so the file can be restored during a rollback

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$old_name
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The old file or directory name
			</td>
		</tr>
					
		<tr>
			<td>
				$new_name
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The new file or directory name
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">recordWrite()</span>

Keeps backup copies of files so they can be restored if there is a rollback

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$file
			</td>
			<td>
									fFile				
			</td>
			<td>
				The file that is being written to
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">reset()</span>

Resets the configuration of the class

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">rollback()</span>

Rolls back a filesystem transaction, it is safe to rollback when no transaction is in progress

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">translateToWebPath()</span>

Takes a filesystem path and translates it to a web path using the rules added

###### Parameters

<table>
	<thead>
		<th>Name</th>
		<th>Type(s)</th>
		<th>Description</th>
	</thead>
	<tbody>
			
		<tr>
			<td>
				$path
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The path to translate
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The filesystem path translated to a web path
		</dd>
	
</dl>




### Instance Methods
<hr />

#### <span style="color:#3e6a6e;">__construct()</span>

Forces use as a static class

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>






