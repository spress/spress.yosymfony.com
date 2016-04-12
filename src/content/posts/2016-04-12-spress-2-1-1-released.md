---
layout: blog/post
title: "Spress 2.1.1 released"
categories: [releases]
tags: [2.x]

changelog_support: true
---
Hi Spress folks! The first maintenance release of Spress 2.1 has been released with two bug fixes.

The complete changelog:

* [Fixed] Bug [#78](https://github.com/spress/Spress/issues/78) has been fixed: "/:basename permalink variable contains .html when using *.html.twig". Related with feature [#73](https://github.com/spress/Spress/issues/73).
* [Fixed] Bug [#79](https://github.com/spress/Spress/issues/79) has been fixed: "Error loading plugin's dependencies with -s option at site:build command".
* [Improved] Clarified the message when `site:build` command is invoked against a non Spress site folder.

--more Read more--

## How to get this version?

If you are using Spress 2.x, the better way is to use `self-update` command:

```
$ spress self-update
``` 

To get this release directly:

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.1.1/spress.phar
```

Enjoy it!
