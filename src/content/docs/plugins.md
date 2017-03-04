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
The easy way to install a plugin is using [Composer](https://getcomposer.org/) tool. In this example,
We will use a plugin called `spress/github-metadata-plugin`.

Create a file named `composer.json` at the root of the site and paste the following content:

```
{
    "require": {
        "spress/github-metadata-plugin": "2.0.*"
    }
}
```
To Install the plugin executes `composer install` command.
