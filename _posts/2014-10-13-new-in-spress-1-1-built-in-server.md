---
layout: blog/post
title: New in Spress 1.1: built-in server and watch for changes.
description: Spress 1.1 came with a built-in server and a resource-watcher
categories: [news]
tags: ['1.1', 'server', 'resource-watcher']
---
Spress 1.1.0 is coming and this time we want to show you two new features:
the **built-in server and the resource watcher**. With the built-in server you 
have a simple web server for viewing your site without any extra requirement.
To enable this server you can use `--server` option with `spress site:build` command.
The other feature included in this version is a resource watcher for watching for
changes and to regenerate your site automatically. To enable this feature you can
use `--watch` option with `spress site:build` command. Each option can be used individually.
This video show us how to work this new options:

```
$ spress site:build --server --watch
```
<iframe width="640" height="360" src="//www.youtube.com/embed/-cRgJEH7ZDc?rel=0" frameborder="0" allowfullscreen></iframe>

Additionally, Spress 1.1.0 beta1 will be ready this week!.