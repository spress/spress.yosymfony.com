---
layout: blog/post
title: "Spress 2.0.0-alpha is out"
description: "The first pre-release of Spress 2.0.0 is out with many features: collections, data sources and other"
categories: [releases]
tags: [2.0.0]
---
We’re super excited to announce that [Spress 2.0.0-alpha](https://github.com/spress/Spress/releases/tag/v2.0.0-alpha) is now available! This is the first and unique alpha pre-release.
Check out the full [changelog](https://github.com/spress/Spress/releases/tag/v2.0.0-alpha) but in a nutshell, this are the
key features:

* Data-sources: (see [#46](https://github.com/spress/Spress/issues/46)) data sources can load site data from certain locations like filesystem or database.
* Data-writer (see [#44](https://github.com/spress/Spress/issues/44)): The DataWriter's responsibility is to persist the content of the items, typically to filesystem.
* New site's structure (see [#41](https://github.com/spress/Spress/issues/41)).
* Collections of content (see [#43](https://github.com/spress/Spress/issues/43)): collections allow you to define a new type of document like page or post.
* Generators (see [#45](https://github.com/spress/Spress/issues/45)): Generators are used for generating new items of content.
* Renderizer (see [#48](https://github.com/spress/Spress/issues/48)): Renderizer are responsible for formatting content.
* Established PHP 5.5 as minimum version (see [#42](https://github.com/spress/Spress/issues/42)).

--more Read more--

## Migrating from Spress 1.x to 2.x?

There are a few incompatibilities and new features that should be considered. Spress 2 comes with a new site structure where 
configuration data and the output folder are located at the first level. The main content is placed at `src` with a folder for 
`includes`, `layouts`, `plugins` and `content`.

Folder mapping: (see [Spresso theme](https://github.com/yosymfony/Spress-theme-spresso/tree/2.0) for more details)

Spress 1.x                    | Spress 2.x
------------------------------|--------------
content (index.html, rss.xml) | `src/content`
`_layouts`                    | `src/layouts`
`_includes`                   | `src/includes`
`_site`                       | `build`
`config.yml`                  | `config.yml`


Plugin system has been reviewed with four new events and five deleted.

List of new events:

* `spress.before_render_blocks`: called just before a item content is rendered.
* `spress.after_render_blocks`: called just after a item content is rendered.
* `spress.before_render_page`: called just before a item content is rendered with layouts.
* `spress.after_render_page`: called just after a item content is rendered with layouts.

List of deleted events:

* `spress.after_convert_posts`.
* `spress.after_render_pagination`.
* `spress.before_render_pagination`.
* `spress.before_render`: replaced by `spress.before_render_blocks` and `spress.before_render_page`.
* `spress.after_render`: replaced by `spress.after_render_blocks` and `spress.after_render_page`.

Plugins and themes of [add-ons](/add-ons/) will be migrated progressively.

See [migrating documentation](/docs/migrating-1.x-to-2.x) for more details.

## How to get this version?

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.0.0-alpha/spress.phar
```

Next release will be beta 1. If you notice any problems, please open a
[issue](https://github.com/spress/Spress/issues) on Github.

Enjoy it!
