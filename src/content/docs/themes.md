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

The [`new:site`](/docs/how-it-works/#new-site-command) command lets you create a blank site.
`--all` option enables a [complete scaffolding of the site](/docs/how-it-works/#site-structure).

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

### Avoids renderizer in some files

In some cases is useful avoid the [renderizer](/docs/developers/renderizer) phase in some kind of files.
A good example of that is a minimized js file with the following content:

{% verbatim %}
```
a = "{#modernizr{top:9px;position:absolute}}"
```
{% endverbatim %}

The prior fragment of code throws a Twig syntax exception. To avoid that, adds `avoid_renderizer` attribute
to the Front matter block or metadata file of the javascript file:

```
avoid_renderizer: true
```

By default, `avoid_renderizer` is false.

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
