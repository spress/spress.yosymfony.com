---
layout: blog/post
title: "spress.phar file has been rebuilt"
categories: [news]
tags: []
---
Due to a filter too much strict on `finder` section of [`box.json`](https://github.com/spress/Spress/blob/master/box.json) file, a file responsible of generating `spress.phar` file, a
[PHP warning was thrown during building a site with plugins](https://github.com/spress/Spress/issues/33).
This issue only affect to `spress.phar`. A new version of `spress.phar` 1.1.0 is
[available for download](https://github.com/spress/Spress/releases/download/v1.1.0/spress.phar).