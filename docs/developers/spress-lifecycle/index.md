---
layout: page-dev
title: Developers &#8250; Lifecycle
description: How to Spress performs a site 
header: { title: Developers, sub: Lifecycle }
prettify: true
---
This article describes how to Spress perform a site:

1. Reads the site configuration file: `config.yml`.
2. Cleans the site folder.
3. Loads plugins and for each call to `initialize` method.
4. Dispatches `spress.start` event.
5. For each post Spress applies a converter and dispatches the events `spress.before_convert` and `spress.after_convert`.
6. For each page Spress applies a converter and dispatches the events `spress.before_convert` and `spress.after_convert`.
7. Dispatches `spress.after_convert_posts` event.
8. For each post Spress applies a render (Twig) and dispatches the events `spress.before_render` and `spress.after_render`.
9. For each page Spress applies a render (Twig) and dispatches the events `spress.before_render` and `spress.after_render`.
10. If pagination of posts is active, for each set of posts, Spress applies a render to the pagination template and dispathes the events `spress.before_render_pagination` and `spress.after_render_pagination`.
11. Copies others files not processables to site folder.
12. Dispathes the event `spress.finish`.