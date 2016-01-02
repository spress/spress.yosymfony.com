---
layout: blog/post
title: "Spress 2.0.0 released"
categories: [releases]
tags: [2.0.0]
---
After ten months working on the new major version of Spress at last is out. The code of
Spress 2.0.0 has been written from the ground up to incorporate new features like **data sources**
or **generators** . This version marks the end-of-life for Spress 1.x. See the
[migration page](/docs/migrating-1.x-to-2.x) for more details.

The list of the most important changes since RC are available at the [changelog page](/about/changelog/#2-0-0).
The documentation for Spress 2 is available at [docs](/docs) pages. Documentation for Spress 1.x is available
[here](/docs/1.0).

## Key features

* A new [site structure](/docs/how-it-works/#site-structure).
* [Collections](/docs/collections).
* [Data sources](/docs/developers/data-sources).
* [Generators](/docs/developers/generators).
* [Renderizers](/docs/developers/renderizer).
* [The data writer](/docs/developers/data-writer).
* [Command plugins](/docs/developers/command-plugins).
* A new way for [paginating](/docs/pagination) items.
* [Taxonomies](/docs/taxonomies).
* [Parsedown converter](/docs/creating-pages/#markdown) for Markdown content.
* [self-update](/docs/how-it-works/#self-update) command.

--more Read more--

## Plugins and themes

The following themes has been ported to Spress 2:

* [Spresso](https://github.com/spress/Spress-theme-spresso). This theme are included in `spress.phar` out of the box.
* [Clean blog](https://github.com/spress-add-ons/Clean-blog-theme).
* [About me](https://github.com/spress-add-ons/About-me-theme).
* [Directive](https://github.com/spress-add-ons/Directive-theme).

The following plugins has been ported to Spress 2:

* [Metadata of a Github repository](https://github.com/spress/Github-metadata-plugin).
* [More tag](https://github.com/yosymfony/Spress-plugin-more-tag).
* [Data loader](https://github.com/yosymfony/spress-plugin-dataloader).

All plugin & theme developers are encouraged to upgrade to this version.

## How to get this version?

To update from Spress 2.0.0-rc:

```
spress self-update
``` 

To get this release directly:

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.0.0/spress.phar
```

Enjoy it!