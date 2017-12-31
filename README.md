[![Author](https://img.shields.io/badge/author-Daniel%20M.%20Hendricks-lightgrey.svg?colorB=9900cc )](https://www.danhendricks.com)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://paypal.me/danielhendricks)
[![WP Engine](https://img.shields.io/badge/WP%20Engine-Compatible-orange.svg)](http://bit.ly/WPEnginePlans)
[![GitHub License](https://img.shields.io/badge/license-GPLv2-yellow.svg)](https://raw.githubusercontent.com/dmhendricks/wordpress-whmcs-licensing-example-plugin/master/LICENSE)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/dmhendricks/wordpress-whmcs-licensing-example-plugin.svg?style=social)](https://twitter.com/danielhendricks)

# WHMCS Licensing Example WordPress Plugin

## Description

This is a very simple example of how to do license key checks against the [Software Licensing](https://www.whmcs.com/software-licensing/) addon for WHMCS.

The author of this plugin has no affiliation with and this plugin is neither endorsed nor supported by WHMCS Limited.

## Requirements

* WordPress 4.5 or higher
* PHP 5.6 or higher
* [Software Licensing](https://www.whmcs.com/software-licensing/) for [WHMCS](https://www.whmcs.com/)

## Installation

### WordPress

Download the [installable ZIP](https://f001.backblazeb2.com/file/hendricks/projects/github/dmhendricks/wordpress-whmcs-licensing-example-plugin/licensing-addon-example.zip) file and upload it to your plugins directory via WP Admin > Plugins > Add New.

### Composer

1. Clone the repository to your WordPress plugins directory.
2. Run `composer install` in the directory from the command prompt.

## Configuration

Before you can test the plugin, you need to modify the `plugin.json` file in the root of the plugin folder.

- `url` - The URL to your WHMCS installation.
- `product_key` - The "Secret Key" as configured in your licensed product in WHMCS.
- `local_key_expire_days` - The number of days between license checks.
- `allow_check_fail_days` - The number of days to allow failed validations (in the event that your WHMCS installation is inaccessible).

## Screenshot

![Settings Page](https://raw.githubusercontent.com/dmhendricks/wordpress-whmcs-licensing-example-plugin/master/assets/screenshot-1.png "Settings Page")
