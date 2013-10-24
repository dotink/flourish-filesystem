# File
## Represents a file on the filesystem, also provides static file-related methods

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
				Kevin Hamer
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
#### <span style="color:#6a6e3d;">$current_line</span>

The current line of the file

#### <span style="color:#6a6e3d;">$current_line_number</span>

The current line number of the file

#### <span style="color:#6a6e3d;">$file_handle</span>

The file handle for iteration

#### <span style="color:#6a6e3d;">$deleted</span>

A backtrace from when the file was deleted

#### <span style="color:#6a6e3d;">$exists</span>

Whether or not the file exists

#### <span style="color:#6a6e3d;">$file</span>

The full path to the file

#### <span style="color:#6a6e3d;">$mask</span>

The file name mask




## Methods
### Static Methods
<hr />

#### <span style="color:#3e6a6e;">determineMimeTypeByContents()</span>

Looks for specific bytes in a file to determine the mime type of the file

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
				$content
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The first 4 bytes of the file content to use for byte checking
			</td>
		</tr>
					
		<tr>
			<td>
				$extension
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The extension of the filetype, only used for difficult files
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
			The mime type of the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">determineMimeTypeByExtension()</span>

Uses the extension of the all-text file to determine the mime type

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
				$extension
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The file extension
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
			The mime type of the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getFileHeader()</span>


<hr />

#### <span style="color:#3e6a6e;">determineMimeType()</span>

Determines the file's mime type by looking at the contents or matching the extension

##### Details

Please see the ::getMimeType() description for details about how the mime type is
determined and what mime types are detected.

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
				The file to check the mime type for
			</td>
		</tr>
					
		<tr>
			<td>
				$contents
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The first 4096 bytes of the file content
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
			The mime type of the file
		</dd>
	
</dl>




### Instance Methods
<hr />

#### <span style="color:#3e6a6e;">tossIfDeleted()</span>

Throws a ProgrammerException if the file has been deleted

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

#### <span style="color:#3e6a6e;">__clone()</span>

Duplicates a file in the current directory when the object is cloned

###### Returns

<dl>
	
		<dt>
			File
		</dt>
		<dd>
			The new File object
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">__construct()</span>

Creates an object to represent a file on the filesystem

##### Details

If multiple File objects are created for a single file, they will reflect changes in
each other including rename and delete actions.

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
				The path to the file
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
		When no file was specified or the path is not a file
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

#### <span style="color:#3e6a6e;">__get()</span>

All requests that hit this method should be requests for callbacks

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
				$method
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The method to create a callback for
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			callback
		</dt>
		<dd>
			The callback for the method requested
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">__sleep()</span>

The iterator information doesn't need to be serialized since a resource can't be

###### Returns

<dl>
	
		<dt>
			array
		</dt>
		<dd>
			The instance variables to serialize
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">__toString()</span>

Returns the filename of the file

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The filename
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">__wakeup()</span>

Re-inserts the file back into the filesystem map when unserialized

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

#### <span style="color:#3e6a6e;">append()</span>

Appends the provided data to the file

##### Details

If a filesystem transaction is in progress and is rolled back, this data will be
removed.  If the file does not yet exist, it will be written to instead.

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
				$data
			</td>
			<td>
									<a href="http://www.php.net/language.pseudo-types.php">mixed</a>
				
			</td>
			<td>
				The data to append to the file
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			File
		</dt>
		<dd>
			The file object, to allow for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">count()</span>

Returns the number of lines in the file

###### Returns

<dl>
	
		<dt>
			integer
		</dt>
		<dd>
			The number of lines in the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">current()</span>

Returns the current line of the file (required by iterator interface)

###### Throws

<dl>

	<dt>
					Dotink\Flourish\NoRemainingException		
	</dt>
	<dd>
		When there are no remaining lines in the file
	</dd>

</dl>

###### Returns

<dl>
	
		<dt>
			array
		</dt>
		<dd>
			The current row
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">delete()</span>

Deletes the current file

##### Details

This operation will NOT be performed until the filesystem transaction has been
committed, if a transaction is in progress. Any non-Flourish code (PHP or system) will
still see this file as existing until that point.

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

#### <span style="color:#3e6a6e;">duplicate()</span>

Creates a new file object with a copy of this file

##### Details

If no directory is specified, the file is created with a new name in the current
directory. If a new directory is specified, you must also indicate if you wish to
overwrite an existing file with the same name in the new directory or create a unique
name.

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
			<td rowspan="3">
				$new_directory
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td rowspan="3">
				The directory to duplicate the file into
			</td>
		</tr>
			
		<tr>
			<td>
									<a href="./Directory.md">Directory</a>
				
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
				Whether to overwrite existing file if present
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			File
		</dt>
		<dd>
			The new File object
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">exists()</span>

Gets whether or not the file exists

###### Returns

<dl>
	
		<dt>
			boolean
		</dt>
		<dd>
			TRUE if the file exists, FALSE otherwise
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getExtension()</span>

Gets the file extension

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The extension of the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getMimeType()</span>

Gets the file's mime type

##### Details

This method will attempt to look at the file contents and the file
extension to determine the mime type. If the file contains binary
information, the contents will be used for mime type verification,
however if the contents appear to be plain text, the file extension
will be used.

The following mime types are supported. All other binary file types
will be returned as `application/octet-stream` and all other text files
will be returned as `text/plain`.

Archive:**

- `application/x-bzip2` BZip2 file
- `application/x-compress` Compress (*nix) file
- `application/x-gzip` GZip file
- `application/x-rar-compressed` Rar file
- `application/x-stuffit` StuffIt file
- `application/x-tar` Tar file
- `application/zip` Zip file

Audio:**

- `audio/x-flac` FLAC audio
- `audio/mpeg` MP3 audio
- `audio/mp4` MP4 (AAC) audio
- `audio/vorbis` Ogg Vorbis audio
- `audio/x-wav` WAV audio
- `audio/x-ms-wma` Windows media audio

Document:**

- `application/vnd.ms-excel` Excel (2000, 2003 and 2007) file
- `application/pdf` PDF file
- `application/vnd.ms-powerpoint` Powerpoint (2000, 2003, 2007) file
- `text/rtf` RTF file
- `application/msword` Word (2000, 2003 and 2007) file

Image:**

- `image/x-ms-bmp` BMP file
- `application/postscript` EPS file
- `image/gif` GIF file
- `application/vnd.microsoft.icon` ICO file
- `image/jpeg` JPEG file
- `image/png` PNG file
- `image/tiff` TIFF file
- `image/svg+xml` SVG file

Text:**

- `text/css` CSS file
- `text/csv` CSV file
- `text/html` (X)HTML file
- `text/calendar` iCalendar file
- `application/javascript` Javascript file
- `application/x-perl` Perl file
- `application/x-httpd-php` PHP file
- `application/x-python` Python file
- `application/rss+xml` RSS feed
- `application/x-ruby` Ruby file
- `text/tab-separated-values` TAB file
- `text/x-vcard` VCard file
- `application/xhtml+xml` XHTML (Real) file
- `application/xml` XML file

Video/Animation:**

- `video/x-msvideo` AVI video
- `application/x-shockwave-flash` Flash movie
- `video/x-flv` Flash video
- `video/x-ms-asf` Microsoft ASF video
- `video/mp4` MP4 video
- `video/ogg` OGM and Ogg Theora video
- `video/quicktime` Quicktime video
- `video/x-ms-wmv` Windows media video

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The mime type of the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getMTime()</span>

Returns the last modification time of the file

###### Returns

<dl>
	
		<dt>
			fTimestamp
		</dt>
		<dd>
			The timestamp of when the file was last modified
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getName()</span>

Gets the filename (i.e. does not include the directory)

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
				$remove_extension
			</td>
			<td>
									<a href="http://www.php.net/language.types.boolean.php">boolean</a>
				
			</td>
			<td>
				If the extension should be removed from the filename
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
			The filename of the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getParent()</span>

Gets the directory the file is located in

###### Returns

<dl>
	
		<dt>
			Directory
		</dt>
		<dd>
			The directory containing the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getPath()</span>

Gets the file's current path (directory and filename)

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
			The path (directory and filename) for the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">getSize()</span>

Gets the size of the file

##### Details

The return value may be incorrect for files over 2GB on 32-bit OSes.

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

Check to see if the current file is writable

###### Returns

<dl>
	
		<dt>
			boolean
		</dt>
		<dd>
			If the file is writable
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">key()</span>

Returns the current one-based line number (required by iterator interface)

###### Throws

<dl>

	<dt>
					Dotink\Flourish\fNoRemainingException		
	</dt>
	<dd>
		When there are no remaining lines in the file
	</dd>

</dl>

###### Returns

<dl>
	
		<dt>
			integer
		</dt>
		<dd>
			The current line number
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">mask()</span>

Masks the filename for certain operations.

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
				$name
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The masked filename to use
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

#### <span style="color:#3e6a6e;">move()</span>

Moves the current file to a different directory

##### Details

Please note that ::rename() will rename a file in its directory or rename it into a
different directory.

If the current file's filename already exists in the new directory and the overwrite
flag is set to FALSE, the filename will be changed to a unique name.

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
				$new_directory
			</td>
			<td>
									<a href="./Directory.md">Directory</a>
				
			</td>
			<td rowspan="3">
				The directory to move this file into
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
		When the directory passed is not a directory or is not readable
	</dd>

</dl>

###### Returns

<dl>
	
		<dt>
			File
		</dt>
		<dd>
			The file object, to allow for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">next()</span>

Advances to the next line in the file (required by iterator interface)

###### Throws

<dl>

	<dt>
					Dotink\Flourish\fNoRemainingException		
	</dt>
	<dd>
		When there are no remaining lines in the file
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

#### <span style="color:#3e6a6e;">output()</span>

Prints the contents of the file

##### Details

This method is primarily intended for when PHP is used to control access
to files.

Be sure to close the session, if open, to prevent performance issues.
Any open output buffers are automatically closed and discarded.

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
				$headers
			</td>
			<td>
									<a href="http://www.php.net/language.types.boolean.php">boolean</a>
				
			</td>
			<td>
				If HTTP headers for the file should be included
			</td>
		</tr>
					
		<tr>
			<td>
				$filename
			</td>
			<td>
									<a href="http://www.php.net/language.pseudo-types.php">mixed</a>
				
			</td>
			<td>
				Present the file as an attachment instead of just outputting type headers - if a string is passed, that will be used for the filename, if `TRUE` is passed, the current filename will be used
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			File
		</dt>
		<dd>
			The file object, to allow for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">read()</span>

Reads the data from the file

##### Details

Reads all file data into memory, use with caution on large files!

This operation will read the data that has been written during the
current transaction if one is in progress.

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
				$data
			</td>
			<td>
									<a href="http://www.php.net/language.pseudo-types.php">mixed</a>
				
			</td>
			<td>
				The data to write to the file
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
			The contents of the file
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">rename()</span>

Renames the current file

##### Details

If the filename already exists and the overwrite flag is set to false, a new filename
will be created.

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
			<td>
				$new_filename
			</td>
			<td>
									<a href="http://www.php.net/language.types.string.php">string</a>
				
			</td>
			<td>
				The new file name
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
			File
		</dt>
		<dd>
			The file object, to allow for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">rewind()</span>

Rewinds the file handle (required by iterator interface)

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

#### <span style="color:#3e6a6e;">valid()</span>

Returns if the file has any lines left (required by iterator interface)

###### Returns

<dl>
	
		<dt>
			boolean
		</dt>
		<dd>
			If the iterator is still valid
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">write()</span>

Writes the provided data to the file

##### Details

Requires all previous data to be stored in memory if inside a transaction, use with
caution on large files!

If a filesystem transaction is in progress and is rolled back, the previous data will be
restored.

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
				$data
			</td>
			<td>
									<a href="http://www.php.net/language.pseudo-types.php">mixed</a>
				
			</td>
			<td>
				The data to write to the file
			</td>
		</tr>
			
	</tbody>
</table>

###### Returns

<dl>
	
		<dt>
			File
		</dt>
		<dd>
			The file object, to allow for method chaining
		</dd>
	
</dl>






