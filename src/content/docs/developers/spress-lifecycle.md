---
layout: page-dev-2.0
title: Developers &#8250; Lifecycle
description: How to Spress performs a site 
header:
  title: Lifecycle
  sub: Developers
menu:
  id: dev 2.0
  title: Lifecycle
  order: 2
prettify: true
---
This article describes how to Spress perform a site:

1. Reads the site configuration file: `config.yml`.
2. Loads plugins from `./src/plugins` folder and for each calls to `initialize` method if `safe` mode is disbled.
3. Dispatches `spress.start` event.
4. Invokes `setUp` method of the [data writer](/docs/developers/data-writer) registered. The default data writer cleans the `./build` folder.
5. Invokes `clear` method of the [Renderizer](/docs/developers/renderizer) registered.
6. Loads the [data sources](/docs/developers/data-sources) and for each calls to `getItems` method.
7. Process [generators](/docs/developers/generators).
8. [Sorts items](/docs/collections/#sort-items). <span class="label label-success">Spress >= 2.1</span>
9. Sets the `next` and `prior` relationships of items belonging to sorted collections. <span class="label label-success">Spress >= 2.1</span>
10. Loads layouts and includes items: invokes `getLayouts` and `getIncludes` method of each data source.
11. For each item Spress applies a [converter](/docs/developers/converters) and dispatches the events `spress.before_convert` and `spress.after_convert`.
12. Process permalinks of items.
13. For each item without an attribute `avoid_renderizer: true` Spress applies a content renderer without layouts and dispatches the events `spress.before_render_blocks` and `spress.after_render_blocks`.
14. For each item without the attribute `avoid_renderizer` Spress applies a content render and dispatches the events `spress.before_render` and `spress.after_render`. After a `spress.after_render` event the item is persisted using `write` method of the [data writer](/docs/developers/data-writer) registered.
15. Dispathes the event `spress.finish`.
