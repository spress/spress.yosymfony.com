---
layout: page-doc-2.0
title: Plugins
description: How to install plugins in your site
header:
  title: Plugins
menu:
  id: doc 2.0
  title: Plugins
  order: 13
prettify: true
---
## Plugin installation {#plugin-installation}

[Plugins](/add-ons) extends Spress with amazing capabilities. They are located at `./src/plugins` folder.
The easy way to install a plugin is using the `add:plugin` command. In this example,
We will use a plugin called `spress/github-metadata-plugin`.

```
$ cd your-site-folder
$ spress add:plugin spress/github-metadata-plugin
```
