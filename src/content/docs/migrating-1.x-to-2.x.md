---
layout: page-doc-2.0
title: Migrating from 1.x to 2.x
description: Migrating from Spress 1.x to Spress 2.x
header:
  title: Migrating from 1.x to 2.x
menu:
  id: doc 2.0
  title: Migrating from 1.x to 2.x
prettify: true
---
There are a few incompatibilities and new features that should be considered. Spress 2 comes with a new site structure where 
configuration data and the output folder are located at the first level. The main content is placed at `src` with a folder for 
`includes`, `layouts`, `plugins` and `content`.

New **features**:

* A new site structure.
* [Data sources](/docs/developers/data-sources).
* [Generators](/docs/developers/generators).
* [Renderizers](/docs/developers/renderizer).
* [The data writer](/docs/developers/data-writer).
* [Command plugins](/docs/developers/command-plugins).
* A new way of [paginating](/docs/pagination) items.
* [Taxonomies](/docs/taxonomies).

## Folder mapping

Spress 1.x                         | Spress 2.x
-----------------------------------|--------------
main content (index.html, rss.xml) | `./src/content`
`_layouts`                         | `./src/layouts`
`_includes`                        | `./src/includes`
`_plugins`                         | `./src/plugins`
`_site`                            | `./build`
`config.yml`                       | `config.yml`

More details about the [site structure](/docs/how-it-works/#site-structure).

## Configuration settings

List of configuration options of `config.yml` deleted because they was marked as deprecated:

* `baseurl`: replaced by `url`.
* `paginate` and `paginate_path`: see [pagination](/docs/pagination) for more details about how to paginate items.
* `limit_posts`
* `processable_ext`
* `destination`
* `posts`
* `includes`
* `layouts`
* `plugins`

## Plugin review

Plugin system has been reviewed with four new events and five deleted. A pluging must implement
[`PluginInterface`](https://github.com/spress/Spress/blob/master/src/Core/Plugin/PluginInterface.php)
instead of extending `Plugin` class. Last one has been deleted.

### Events

The `EnviromentEvent` class has definitely been deleted because contains a typo. Now, `spress.start`
reciebes [`EnvironmentEvent`](/docs/developers/#environmentevent) class as an argument.

The events `spress.before_convert` and `spress.after_convert` receive a
[ContentEvent](/docs/developers/#contentevent) object as an argument instead of ConvertEvent.
Last one has been deleted.

The complete [list of events](/docs/developers/events-list) are detailed at developers doc.

List of new events:

* `spress.before_render_blocks`: called just before a item content is rendered.
* `spress.after_render_blocks`: called just after a item content is rendered.
* `spress.before_render_page`: called just before a item content is rendered with layouts.
* `spress.after_render_page`: called just after a item content is rendered with layouts.

List of deleted events:

Events                            | Replacement
----------------------------------|------------
`spress.after_convert_posts`      | You can use the first invoke to `spress.before_render_blocks`.
`spress.after_render_pagination`  |
`spress.before_render_pagination` |
`spress.before_render`            | `spress.before_render_blocks` and `spress.before_render_page`.
`spress.after_render`             | `spress.after_render_blocks` and `spress.after_render_page`.

### Converters

Methods `initialize` and `getSupportExtension` of `ConverterInterface` have been deleted. `getSupportExtension`
method has been replaced by `matches` method. Now, `matches` method returns `true` if file's extension is support
by a converter. More details about [converters](/docs/developers/converters).

### Plugin installer

For distributable plugins using Composer tool, the Spress add-ons installer has changed
its package name from `yosymfony/spress-installer` to `spress/spress-installer`. Edit the `composer.json`
file and replace the prior package with the newest:
```
{
    "require": {
        "spress/spress-installer": "~2.0"
    }
}
```
