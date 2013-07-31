# Directory
## Represents a directory on the filesystem, also provides static directory-related methods

_Copyright (c) 2007-2011 Will Bond, others_.
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

### Instance Properties
#### <span style="color:#6a6e3d;">$deleted</span>

A backtrace from when the file was deleted

#### <span style="color:#6a6e3d;">$directory</span>

The full path to the directory

#### <span style="color:#6a6e3d;">$exists</span>

Whether or not the file exists




## Methods
### Static Methods
<hr />

#### <span style="color:#3e6a6e;">makeCanonical()</span>

Makes sure a directory has a `/` or `\` at the end

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
				$directory
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The directory to check
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
			The directory name in canonical form
		</dd>
	
</dl>




### Instance Methods
<hr />

#### <span style="color:#3e6a6e;">__construct()</span>

Creates an object to represent a directory on the filesystem

##### Details

If multiple Directory objects are created for a single directory, they will reflect
changes in each other including rename and delete actions.

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
				$directory
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The path to the directory
			</td>
		</tr>
					
		<tr>
			<td>
				$skip_checks
			</td>
			<td>
									<a href="http://www.php.net/language.types.boolean.php">boolean</a>
				
			</td>
			<td>
				If file checks should be skipped
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
		When no directory was specified or path is not a directory
	</dd>

</dl>

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

#### <span style="color:#3e6a6e;">__toString()</span>

Returns the full filesystem path for the directory

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The full filesystem path
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">clear()</span>

Removes all files and directories inside of the directory

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

#### <span style="color:#3e6a6e;">create()</span>

Creates the directory on the filesystem

##### Details

The directory creation is done recursively, so if any of the parent
directories do not exist, they will be created.

This operation will be reverted by a filesystem transaction being rolled back.

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
				$mode
			</td>
			<td>
									numeric				
			</td>
			<td>
				The mode (permissions) to use when creating the directory.
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			Directory
		</dt>
		<dd>
			The Directory object for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">delete()</span>

Will delete a directory and all files and directories inside of it

##### Details

This operation will not be performed until the filesystem transaction has been
committed, if a transaction is in progress. Any non-Flourish code (PHP or system) will
still see this directory and all contents as existing until that point.

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

#### <span style="color:#3e6a6e;">exists()</span>

Gets whether or not the directory exists

###### Returns

<dl>
	
		<dt>
			boolean
		</dt>
		<dd>
			TRUE if the directory exists, FALSE otherwise
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getName()</span>

Gets the name of the directory

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The name of the directory
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getParent()</span>

Gets the parent directory

###### Returns

<dl>
	
		<dt>
			Directory
		</dt>
		<dd>
			The object representing the parent directory
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getPath()</span>

Gets the directory's current path

##### Details

If the web path is requested, uses translations set with
Filesystem::addWebPathTranslation()

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
				$translate_to_web_path
			</td>
			<td>
									<a href="http://www.php.net/language.types.boolean.php">boolean</a>
				
			</td>
			<td>
				If the path should be the web path
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
			The path for the directory
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getSize()</span>

Gets the disk usage of the directory and all files and folders contained within

##### Details

This method may return incorrect results if files over 2GB exist and the server uses a
32 bit operating system

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
				$format
			</td>
			<td>
									<a href="http://www.php.net/language.types.boolean.php">boolean</a>
				
			</td>
			<td>
				If the filesize should be formatted for human readability
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
				The number of decimal places to format to (if enabled)
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
			The filesize in bytes
		</dd>
		
		<dt>
			string
		</dt>
		<dd>
			If formatted a string with filesize in b/kb/mb/gb/tb
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">isWritable()</span>

Check to see if the current directory is writable

###### Returns

<dl>
	
		<dt>
			boolean
		</dt>
		<dd>
			If the directory is writable
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">move()</span>

Moves the current directory into a different directory

##### Details

Please note that ::rename() will rename a directory in its current parent directory or
rename it into a different parent directory.

If the current directory's name already exists in the new parent directory and the
overwrite flag is set to false, the name will be changed to a unique name.

This operation will be reverted if a filesystem transaction is in progress and is later
rolled back.

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
				$new_parent_directory
			</td>
			<td>
									<a href="./">Directory</a>
				
			</td>
			<td rowspan="3">
				The new parent directory
			</td>
		</tr>
			
		<tr>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
		</tr>
								
		<tr>
			<td>
				$overwrite
			</td>
			<td>
									<a href="http://www.php.net/language.types.boolean.php">boolean</a>
				
			</td>
			<td>
				Whether to overwrite a any destination with the same name
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
		When the new parent directory is invalid
	</dd>

</dl>

###### Returns

<dl>
	
		<dt>
			Directory
		</dt>
		<dd>
			The directory object, to allow for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">rename()</span>

Renames the current directory

##### Details

This operation will NOT be performed until the filesystem transaction has been
committed, if a transaction is in progress. Any non-Flourish code (PHP or system) will
still see this directory (and all contained files/dirs) as existing with the old paths
until that point.

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
				$new_dirname
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The new directory name
			</td>
		</tr>
					
		<tr>
			<td>
				$overwrite
			</td>
			<td>
									<a href="http://www.php.net/language.types.boolean.php">boolean</a>
				
			</td>
			<td>
				Whether to overwrite a any destination with the same name
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

#### <span style="color:#3e6a6e;">scan()</span>

Performs a scandir() on a directory, removing the `.` and `..` entries

##### Details

If the `$filter` looks like a valid PCRE pattern - matching delimeters (a delimeter can
be any non-alphanumeric, non-backslash, non-whitespace character) followed by zero or
more of the flags `i`, `m`, `s`, `x`, `e`, `A`, `D`,  `S`, `U`, `X`, `J`, `u` - then
[http://php.net/preg_match `preg_match()`] will be used.

Otherwise the `$filter` will do a case-sensitive match with `*` matching zero or more
characters and `?` matching a single character.

On all OSes (even Windows), directories will be separated by `/`s when comparing with
the `$filter`.

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
				$filter
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				A PCRE or glob pattern to filter files/directories by path
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
			The File (or Image) and Directory objects for the child files/directories
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">scanRecursive()</span>

Performs a **recursive** scandir() on a directory, removing the `.` and `..` entries

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
				$filter
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				A PCRE or glob pattern to filter files/directories by path
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
			The File (or Image) and Directory objects for the child* files/directories
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">tossIfDeleted()</span>

Throws an exception if the directory has been deleted

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>






