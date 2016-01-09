---
layout: blog/post
title: "Spress 2.0.1 released with better support for Windows users"
description: "Spress 2.0.1 released with better support for Windows users"
categories: [releases]
tags: [2.x,windows]

changelog_support: true
---
A new maintenance release of Spress 2.0 is out with a few fixes and improvements.

The complete changelog:

* [Improved] Normalized the directory separator to `/` irrespective of the operating system.
* [Improved] [Spresso theme](https://github.com/spress/Spress-theme-spresso/releases/tag/v2.0.1) updated to 2.0.1.
* [Fixed] Fixed the file's extension `twig.html` in configuration files.
* [Fixed] Fixed the exception "A previous item exists with the same id" thrown by Taxonomy generator due to a key sensitive issue. A normalize method has been added. e.g: "news", "NEWS", " News " are the same term: "news".
* [Fixed] Fixed the namespace of `AttributeValueException` at `PaginationGenerator` class.

--more Read more--

## Support for Windows users

This release marks the beginning of supporting Windows users. We have added the
[AppVeyor service](https://ci.appveyor.com/project/yosymfony/spress) to our CI workflow
for testing Spress on Windows. From now, every *push* or *pull-request* to the Spress repository
will be tested on Windows.

<img class="center-block" src="{{ site.url }}/assets/img/spress-on-appveyor.png">

## How to get this version?

If you are using Spress 2.x, the better way is to use `self-update` command:

```
$ spress self-update
``` 

To get this release directly:

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.0.1/spress.phar
```

Enjoy it!
