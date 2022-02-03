# Advance Excel Import 💯
##### _GUI Interface to Import_

[![Packagist License][badge_license]](LICENSE) [![For PHP][badge_php]][link-github-repo] ![Scrutinizer Code Quality][badge_quality] [![Github Issues][badge_issues]][link-github-issues] ![Github Stars][badge_stars] ![Github Forks][badge_forks] [![Packagist][badge_package]][link-packagist] [![Packagist Release][badge_release]][link-packagist] [![Packagist Downloads][badge_downloads]][link-packagist]

Advance Excel Import allows to import data without writing import script for each project, using this package you will be able to import data using a GUI interface withouth writing any script.

## Installation

Via Composer

```bash
composer require sunarctech/excel-import
```
## Instructions
Just install this package and make changes accordingly in configuration file

## Available Configurations
##### Exclude Fields
Add the field which you wish should not be imported

##### Default
```php
'fields_to_be_excluded' => [
    'id', 'created_at', 'updated_at', 'deleted_at'
],
```

##### File Path
Define the public path where to file should be uploaded, and read.

##### Default
```php
'default_path' => 'assets/excel/global',
```

##### Import Session Life
Define the lifetime for a import session in minutes.

##### Default
```php
'session_lifetime' => 10,
```

### Publish Config file
```php
php artisan vendor:publish --provider="Sunarc\ImportExcel\ImportExcel\ImportExcelServiceProvider" --tag="config"
```

## Features

- Import an excel file
- Maintain session lifetime for file to be saved on server via configuration
- Supports xls,xlsx.csv
- Choose table name and column on which excel data need to be imported

## Requirments

###### Required Packages

- doctrine/dbal
- illuminate/support
- maatwebsite/excel

###### PHP extension

- php_zip
- php_xml
- php_gd2
- php_iconv
- php_simplexml
- php_xmlreader
- php_zlib

## Routes
Two routes been registered automatically which allows to import the file and choose the columns.
Using **import** as prefix. 
- **youdomainname/import/file-upload**
    - Using this route you can upload the file which will be saved into public storage.
- **youdomainname/import/start-import**
    - This will be used for selection and import process start.

## Samples
###### Sample File - [sampleimport.xlsx](https://github.com/sunarcrajneesh/excel-import/files/7991831/sampleimport.xlsx)

#### Import File
![image](https://user-images.githubusercontent.com/45708520/152282703-10cbf934-37ae-4624-88ab-a42d09ae4a8a.png)

#### Start Import
![image](https://user-images.githubusercontent.com/45708520/152282848-d354cd34-864a-4290-b660-f4d4c95516c6.png)

## Created by SunArc Technologies

We are the leading Software Development Company providing end-to-end IT services & solutions to our esteemed customers in multiple industries and domains for the past 18+ years? Give us a call.

https://sunarctechnologies.com/
info@sunarctechnologies.com
+91-8764025209

## :wrench: Supported Versions

Versions supported.

| Version | Laravel Version | PHP Version | Support |
|---- |----|----|----|
| 0.1 | <=7.0 | 7.3 - 8.x | All features |

## License

The MIT Public License. Please see [LICENSE](LICENSE) for more information.
   
[badge_php]:         https://img.shields.io/badge/PHP-7.3%20to%208.x-orange.svg
[badge_issues]:      https://img.shields.io/github/issues/sunarcrajneesh/excel-import
[badge_release]:     https://badgen.net/packagist/v/sunarctech/excel-import
[badge_quality]:     https://img.shields.io/scrutinizer/g/sunarcrajneesh/excel-import.svg
[badge_downloads]:   https://img.shields.io/packagist/dt/sunarctech/excel-import
[badge_package]:     https://img.shields.io/badge/package-sunarctech/excel--import-blue
[badge_license]:     https://img.shields.io/github/license/sunarcrajneesh/excel-import
[badge_stars]:       https://img.shields.io/github/stars/sunarcrajneesh/excel-import
[badge_forks]:       https://img.shields.io/github/forks/sunarcrajneesh/excel-import

[link-author]:        https://github.com/sunarcrajneesh
[link-github-repo]:   https://github.com/sunarcrajneesh/excel-import
[link-github-issues]: https://github.com/sunarcrajneesh/excel-import/issues
[link-contributors]:  https://github.com/sunarcrajneesh/excel-import/graphs/contributors
[link-packagist]:     https://packagist.org/packages/sunarctech/excel-import
