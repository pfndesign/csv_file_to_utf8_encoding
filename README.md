# csv_file_to_utf8_encoding
convert CSV file encoding to utf-8

# usage
```php
$cv = new convert_csv_to_utf8($file_address,$saveto=false);
```
- file_address : csv file address
- saveto (optional) : save fixed csv file to location . if not set fixed csv file will be replaced with original csv
### return : return converted/true if successfully convert/fixed csv file , return filenotfind/false if file is not exist

# convert_encoding
```php
$string = convert_csv_to_utf8::convert_to_utf8($string, $encoding);
```
- string : your text
- encoding : your text encoding
### return : return encoded text to utf-8
