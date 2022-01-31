# Excel Import 💯

[![Packagist License][badge_license]](LICENSE)
[![For PHP][badge_php]][link-github-repo]
![Scrutinizer Code Quality][badge_quality]
[![Github Issues][badge_issues]][link-github-issues]
![Github Stars][badge_stars]
![Github Forks][badge_forks]
[![Packagist][badge_package]][link-packagist]
[![Packagist Release][badge_release]][link-packagist]
[![Packagist Downloads][badge_downloads]][link-packagist]

Import data using excel in database from a single file without adding any external script in your project with the help of this package you can easily import data using GUI interface!.

## Installation

Via Composer

```bash
composer require sunarc/excel-import
```
## Instructions
Just install this package and make changes accordingly in configuration file

### Publish Config file
```php
php artisan vendor:publish --provider="Sunarc\ImportExcel\ImportExcel\ImportExcelServiceProvider" --tag="config"
```

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

## License

The MIT Public License. Please see [LICENSE](LICENSE) for more information.

[badge_php]:         https://img.shields.io/badge/PHP-7.3%20to%208.x-orange.svg
[badge_issues]:      https://img.shields.io/github/issues/sunarctech/excel-import
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
