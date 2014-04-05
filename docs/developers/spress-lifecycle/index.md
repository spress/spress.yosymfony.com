---
layout: page-dev
title: Developers &#8250; Lifecycle
description: How to Spress performs a site 
header: { title: Developers, sub: Lifecycle }
prettify: true
---
This article describes how to Spress perform a site.

1. Read site configuration `config.yml`.
2. Clean the site folder.
3. Load plugins and for each of this call to `initialize` method.
4. Dispatch `spress.start` event.
5. For each post Spress applies a converter and dispatch the events `spress.before_convert` and `spress.after_convert`.
6. For each page Spress applies a converter and dispatch the events `spress.before_convert` and `spress.after_convert`.
7. Dispatch `spress.after_convert_posts` event.
8. For each post Spress applies a render (Twig) and dispatch the events `spress.before_render` and `spress.after_render`.
9. For each page Spress applies a render (Twig) and dispatch the events `spress.before_render` and `spress.after_render`.
10. If pagination of posts is active, for each set of posts, Spress applies a render to the pagination template and dispath the events `spress.before_render_pagination` and `spress.after_render_pagination`.
11. Copy others files not processables.
12. Dispath the event `spress.finish`.