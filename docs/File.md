# File

The `File` class is used to work with files.

## Accessing Files

Regardless of whether or not a file exists a `File` object can be instantiated to represent it.

```
$file = new File('/etc/passwd');

printf('The file %s ' . ($file->exists() ? 'exists' : 'does not exist'), $file);

```

**Output (on Linux)**

```
The file passwd exists
```

You can see in the above code sample that the `exists()` method can be used to determine whether or not a file already exists, i.e. whether or not it has been written to disk yet.


## Creating a File

```
$content = 'This is the content of the file';
$file    = new File('/tmp/non_existent_file.txt');

printf('The file %s ' . ($file->exists() ? 'exists' : 'does not exist'), $file);

$file->write($content);

printf('The file %s ' . ($file->exists() ? 'exists' : 'does not exist'), $file);
```

**Output**
```
The file non_existent_file.txt does not exist
The file non_existent_file.txt exists
```

If the directory for the file does not exist an attempt will be made to create it and any necessary parent directories in order to write the file.  The highest leveld directory which does exist will require write permissions for the user which the PHP script is executing as.


```
$file = new File('/directory/not_writable.txt');

$file->write('This will throw an exception');
```

**Output**
```
Exception:  The directory, "/directory/", could not be created; parent is not writable
```

## Reading a File

```
$file = new File('/etc/fstab');

echo $file->read()
```

**Output**
```
# /etc/fstab: static file system information.
#
# Use 'blkid' to print the universally unique identifier for a
# device; this may be used with UUID= as a more robust way to name devices
# that works even if disks are added and removed. See fstab(5).
#
# <file system> <mount point>   <type>  <options>       <dump>  <pass>
proc            /proc           proc    nodev,noexec,nosuid 0       0
# / was on /dev/sda2 during installation
UUID=495a9053-06fe-458d-a037-af9883f5dcda /               ext4    errors=remount-ro 0       1
# swap was on /dev/sda3 during installation
#UUID=b590191a-b3b0-4323-ad69-59e55adc5c29 none            swap    sw              0       0
/dev/mapper/cryptswap1 none swap sw 0 0
```

## Getting a Mime Type

If a file has available content (if it exists and can read some data) attempts will be made to determine the filetype based on the content, otherwise, the extension will be used for a simple lookup of common extensions.  While this does not cover every possible filetype, the most common ones should be addressed.

```
$file = new File('/path/to/my_image.png');

echo $file->getMimeType();
```

**Output**
```
image/png
```
