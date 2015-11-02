---
layout: page-dev-2.0
title: Developers &#8250; Lifecycle
description: How to Spress performs a site 
header: { title: Lifecycle, sub: Developers }
prettify: true
---
This article describes how to Spress perform a site:

1. Reads the site configuration file: `config.yml`.
2. Loads plugins at `./src/plugins` and for each calls to `initialize` method if `safe` mode is disbled.
3. Dispatches `spress.start` event.
4. Invokes `setUp` method of the data writer registered. The default data writer cleans the `./build` folder.
5. Invokes `clear` method of the Renderizer registered.
6. Loads the data sources and for each calls to `getItems` method.
7. Performs generators.
8. Loads layouts and includes items: invokes `getLayouts` and `getIncludes` method of each data source.
9. For each item Spress applies a converter and dispatches the events `spress.before_convert` and `spress.after_convert`.
10. For each item without the attribute `avoid_renderizer` Spress applies a content renderer without layouts and dispatches the events `spress.before_render_blocks` and `spress.after_render_blocks`.
11. For each item without the attribute `avoid_renderizer` Spress applies a content render and dispatches the events `spress.before_render` and `spress.after_render`. After a `spress.after_render` event the item is persisted using `write` method of the data writer registered.
12. Dispathes the event `spress.finish`.
