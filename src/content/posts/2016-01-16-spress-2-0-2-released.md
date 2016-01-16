---
layout: blog/post
title: "Spress 2.0.2 released"
description: "Spress 2.0.2 released"
categories: [releases]
tags: [2.x]

changelog_support: true
---
A new maintenance release of Spress 2.0 is out with a fix for an issue with the content
retrieved by `getContent` method of `after_render_page` event.

The complete changelog:

* [New] `PluginTester` class has been added to the core for testing plugins easily.
* [Fixed] Fixed an issue with the content retrieved by `after_render_page` event.
* [Fixed] A constant name of `ItemInterface` has been changed: `SNAPSHOT_AFTER_PAGE` -> `SNAPSHOT_AFTER_RENDER_PAGE`.

--more Read more--

## How to get this version?

If you are using Spress 2.x, the better way is to use `self-update` command:

```
$ spress self-update
``` 

To get this release directly:

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.0.2/spress.phar
```

Enjoy it!
