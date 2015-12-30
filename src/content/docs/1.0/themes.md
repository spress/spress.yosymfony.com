---
layout: page-doc
title: Themes
description: Create themes for Spress
header:
  title: Themes
menu:
  id: doc 1.0
  title: Themes
  order: 10
prettify: true
---
**Themes are simply sites**. Spress uses the power of Twig for render templates. You can reusable parts
of your HTML and write your templates with a easy languaje. For more information
about Twig, see the [Twig web page](http://twig.sensiolabs.org).

## Create a site blank

With the `spress new:site` [command](/docs/1.0/how-it-work/#site-new-command) you
can create a blank site with the below structure:

```
.
|- composer.json
|- config.yml
|- index.html
|- _layouts/
|- _posts/
```

The command has an extra `--all` option to create a complete scaffolding of the
site:

```
.
|- composer.json
|- config.yml
|- _includes/
|- index.html
|- _layouts/
|- _posts/
|- _plugins/
```

## Hierachical layouts

Your layouts can inherit from other layouts. Layouts are located at `_layout`
folder.

```
_layout/
|- default.html
|- post.html
```

The `default.html` may hold the general HTML definitions like *html* and *head* 
tags:

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

The `post.html` can to inheritance from `default.html`:

{% verbatim %}
```
---
layout: default
---
{% block content %}

    <p>This is the layout for posts</p>

    {{ page.content }}
    
{% endblock %}
```
{% endverbatim %}

## Reusable content

The reusable parts are located at `_includes` folder.

```
_include
|- nav.html
|- widget
|  |- email.html
```

To include a reusable part use `include` Twig statement:

{% verbatim %}
<pre>
    <code class="twig">
        {% include 'nav.html' %}
        {% include 'widget/email.html' %}
    </code>
</pre>
{% endverbatim %}

More information about 
[include statement of Twig](http://twig.sensiolabs.org/doc/tags/include.html).

## Plugins installation

You can use [plugins](/add-ons) in your site. For to do it, go to your site folder
and create `composer.json` file and add the following content:

<pre>
    <code class="json">
        {
            "require": {
                "spress/github-metadata-plugin": "~1.0-dev"
            },
            "config": {
                "vendor-dir": "_plugins/vendors"
            }
        }
    </code>
</pre>

Next, run `composer update` command and then you can use the plugin in your site.
The plugins are availables in `_plugins` folder.

In the previous example, you declare that need the latest version of a plugin called 
`spress/github-metadata-plugin`.

## Create a redistributable theme

Your own themes can be downloaded by other users and be using for building their web pages
or as base for new themes. A theme can be installed downloading manually, using GIT for
getting the repository or install globally with Composer.

For create a distribuible package with Composer, you shuld create a repository
in Github or similar and to register it in [Packagist](https://packagist.org/about) repository.

Example of a [theme](https://github.com/yosymfony/Spress-theme-spresso). 
You can see it in [action](http://yosymfony.github.io/Spress-example/).

## How to install a new theme?

Several ways to do it.

### Download a copy

* Get a copy of the latest release.
* Uncompress it.
* Go to theme folder
* `spress site:build --server --watch`

### With Git

* Fork the repository
* Clone it: `https://github.com/YOUR-USER/THEME-REPOSITORY.git`
* Go to `THEME-REPOSITORY` folder
* `spress site:build --server --watch`

### Globally

**This option is not available using `spress.phar`**

Go to your Spress installation folder i.e ~/Spress and add the following depencency
to your `composer.json` file

<pre>
    <code class="json">
        "require": {
            "spress-add-ons/about-me-theme": "1.0.*@dev"
        }
    </code>
</pre>

and then run the following command to install the dependency.

```
$ composer update
```

Next create your new site:

```
$ spress new:site /your-site-dir about-me
$ cd /your-site-dir
$ spress site:build --server --watch
```