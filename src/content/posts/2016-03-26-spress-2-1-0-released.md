---
layout: blog/post
title: "Spress 2.1.0 released"
description: "Spress 2.1.0 released with many features and improvements"
categories: [releases]
tags: [2.x]

changelog_support: true
---
Hi community. To make your weekend all the better, we have just released Spress 2.1.0
with many features and improvements.

## Key features

* [New] **Sorted items in [collections](/docs/collections/#sort-items)**. Feature thanks to [jjk-jacky](https://github.com/jjk-jacky).
* [New] **Attributes referring to the [previous and next items in a sorted collection](/docs/collections/#relationships)**. Feature thanks to [jjk-jacky](https://github.com/jjk-jacky).
* [New] **Calling an existing command** in [command plugins](/docs/developers/command-plugins/#calling-command).
* [New] **Support for extending Spress with Twig tags.** Contributed by [jjk-jacky](https://github.com/jjk-jacky) in [#65](https://github.com/spress/Spress/pull/65).
* [New] **Support `.twig` extention**. This feature lets you work more appropriately with pages using IDEs such as PHPStorm. Feature thanks to [peterfox](https://github.com/peterfox).
* [Improved] **Improved permalinks customizations**. Contributed by [jjk-jacky](https://github.com/jjk-jacky) in [#65](https://github.com/spress/Spress/pull/64).
* [Fixed] Fixed the path available at `page.path` variable. Prior to this version, this variable contains the relative path to `src/content/` but with the filename extension changed by the [Converter](/docs/developers/converters/). Now, the original filename extension isn't altered.

--more Read more--

You can see the [complete changelog here](/about/changelog/#2-1-0).

## How to get this version?

If you are using Spress 2.x, the better way is to use `self-update` command:

```
$ spress self-update
``` 

To get this release directly:

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.1.0/spress.phar
```

Enjoy it!
