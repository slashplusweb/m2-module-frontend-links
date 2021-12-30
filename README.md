# :package_name for Magento 2 
:package_description

[![Latest Version on Packagist](https://img.shields.io/packagist/v/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
[![Total Downloads](https://img.shields.io/packagist/dt/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
[![License](https://img.shields.io/packagist/l/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
[![PHP Support](https://img.shields.io/packagist/php-v/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
<!--delete-->
---
This package can be used as to scaffold a Magento 2 package.
Follow these steps to get started:

1. Press the "Use template" button at the top of this repo to create a new repo with the contents of this skeleton
   <br>*Note*: By default the repository url (but not the package name) is prefixed with "m2-" in readme files etc., so choose your package name and prefix the repo with "m2-" this if you don't want to rename such files manually. <br><br>
   _Example:_ 
    * URL: `github.com/foouser/m2-module-bar-baz/` 
    * Package name (i.e. packagist): `foouser/module-bar-baz` 
2. Run "php ./configure.php" to run a script that will replace all placeholders throughout all the files
   <br>*Note*: Please use the same package name as defined in step 1, so all references are valid 
3. Have fun creating your package.
---
<!--/delete-->
This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require :vendor_slug/:package_slug
```

after that install it via:
```php
bin/magento setup:upgrade
```

or just enable the module:
```php
bin/magento module:enable VendorName_Skeleton;
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [:author_name](https://github.com/:author_username)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
