---
layout: blog/post
title: "Spress 3 is here"
categories: [releases]
tags: [3.x]

changelog_support: true
---
Hi community, it's been a long time coming but Spress is back with the version 3.
This version does not content new features but some of the main packages have been updated such
us Twig (from 1.x to 3.x) and Symfony components (from 3.1 to 4.4). Another
important thing is that **PHP 7.4 is the minimum PHP version that Spress 3 will run on**.
Spress 3 should be backward compatible with version 2.2.0.

## Changelog
* [New] Fixed the PHP minimum version to 7.4 in `composer.json` file.
* [New] Added the supporting class `Filesystem`. It is an extension of Symfony Filesystem component with a method for reading the content of files.
* [Improved] Updated Symfony components to 4.4.
* [Improved] Updated Twig to 3.0.
* [Improved] Updated "michelf/php-markdown" to 1.9.
* [New] Added class `DependencyResolver`, a simple dependency resolver. It is useful for keeping tracks of inter-document dependencies.
* [Deleted] The configuration option `layout_ext` is not necessary anymore. Now, the option `text_extensions` is used to recognize layouts files.
* [Improved] The class `FilesystemDataSource` returns layout item identifiers without file extensions when they are unique. In case of name collision, the filename extension will be added.
* [Fixed] Now, Appveyor CI installs PHP and Composer using Chocolatey package system.

If you encounter issues with the new release or have suggestions, 
please use [GitHub Issues](https://github.com/spress/spress/issues) or the comments below.

Enjoy!