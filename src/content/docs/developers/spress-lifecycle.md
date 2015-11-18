---
layout: page-dev
title: Developers &#8250; Lifecycle
description: How Spress generates a site 
header:
  title: Lifecycle
  sub: Developers
menu:
  id: dev 1.0
  title: Lifecycle
  order: 2
prettify: true
---
This article describes how Spress generates a site.

During its lifecycle Spress goes through following steps:

1. Reads the site configuration file: `config.yml`
2. Cleans the site folder
3. Loads plugins and `initialize` method for each one
4. Dispatches `spress.start` event
5. For each post Spress applies a converter and dispatches the events `spress.before_convert` and `spress.after_convert`
6. For each page Spress applies a converter and dispatches the events `spress.before_convert` and `spress.after_convert`
7. Dispatches `spress.after_convert_posts` event
8. For each post Spress applies a render (Twig) and dispatches the events `spress.before_render` and `spress.after_render`
9. For each page Spress applies a render (Twig) and dispatches the events `spress.before_render` and `spress.after_render`
10. If pagination of posts is active, for each set of posts, Spress applies a render to the pagination template and dispatches the events `spress.before_render_pagination` and `spress.after_render_pagination`
11. Copies others not processable files to site `build` folder
12. Dispatches the event `spress.finish`
