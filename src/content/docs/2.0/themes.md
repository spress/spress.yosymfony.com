---
layout: page-doc-2.0
title: Themes
description: Create themes for Spress
header:
  title: Themes
menu:
  id: doc 2.0
  title: Themes
  order: 12
prettify: true
---
**Themes are simply sites**. Spress uses the power of [Twig](http://twig.sensiolabs.org)
to render templates. You can reuse parts of your HTML and create templates with a easy language.

## Creating a theme

The [`new:site`](/docs/2.0/how-it-works/#new-site-command) command lets you create a blank site.
`--all` option enables a [complete scaffolding of the site](/docs/2.0/how-it-works/#site-structure).

```
$ spress new:site my-site --all
```

### Layouts {#layouts-inheritance}

Layouts describes how the content is distributed in a page. Layouts are simple HTML & Twig
files located at `./src/layouts` and they can inherit from other layouts

In this example, `default.html` file may hold the general HTML definitions like `html` and `head` 
tags with metas, title and assets:

{% verbatim %}
```
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ site.description }}">
        <meta name="author" content="{{ site.author.name }}">
        <title>{{ page.title | default(site.title) }}</title>
        <link href="/assets/style.css" rel="stylesheet" media="screen">
    </head>
    <body>
        {% block content %}
            {{ page.content }}
        {% endblock %}
    </body>
</html>
```
{% endverbatim %}

Prior layout contains a `content` block and this will be filled out with the page content.

Another layout could be added for describing how a post page is: `post.html`. This one inherited 
from `default.html` using the `layout` attribute:

{% verbatim %}
```
---
layout: "default"
---
{% block content %}

    <h1>{{ page.title }}</h1>

    {{ page.content }}
    
{% endblock %}
```
{% endverbatim %}

### Reusable content {#reusable-content}

Reusable parts, *partials* are simples HTML & Twig files located at `./src/includes` folder.

To render a partial call `include` with the identifier surrounded by quotes:

{% verbatim %}
```
{% include 'nav.html' %}
{% include 'widget/email.html' %}
```
{% endverbatim %}

It's also possible to pass custom variables to a patial using `with` keyword:

{% verbatim %}
```
{% include 'nav.html' with {'menu': 'top'} %}
```
{% endverbatim %}

More information about [Twig include statement](http://twig.sensiolabs.org/doc/tags/include.html).

## Plugin installation {#plugin-installation}

You can use [plugins](/add-ons) on your site. To do it, you have to create 
`composer.json` file in your site folder and add the require statement
with the name of the plugin:
 
We will use a plugin called `spress/github-metadata-plugin` as example.
To add it to your site, you simply have to add following changes in your
site `composer.json` and run `composer update` afterwards:

```
{
    "require": {
        "spress/github-metadata-plugin": "~1.0-dev"
    }
}
```

Plugin will be available in `./src/plugins` folder.


## Create a redistributable theme {#redistributable-themes}

Your own themes can be downloaded by other users and used for building their web pages
or as base for new themes. A theme can be installed by downloading it manually or 
using GIT for getting the repository.

To create a distributable package with Composer, you should create a repository
on Github or similar site and register it in [Packagist](https://packagist.org/about) repository.

Example of a [theme](https://github.com/yosymfony/Spress-theme-spresso/tree/2.0). 
You can see it in [action](http://yosymfony.github.io/Spress-example/).

## How to install a new theme? {#installing-new-theme}

There are several ways to do it.

### Download a copy {#install-theme-download}

* Get a copy of the latest release.
* Uncompress it.
* Go to theme folder
* Run `spress site:build --server --watch`

### With Git {#install-theme-git}

* Fork theme repository (so you will be able to modify it later on)
* Clone it: `git clone https://github.com/YOUR-USER/THEME-REPOSITORY.git folder-name-for-cloned-theme`
* Go to `folder-name-for-cloned-theme` folder
* Run `spress site:build --server --watch`
