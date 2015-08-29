---
layout: page-doc
title: Themes
description: Create themes for Spress
header: { title: Themes }
prettify: true
---
**Themes are simply sites**. Spress uses the power of Twig to render templates. You can reuse parts
of your HTML and create templates with a easy language. For more information
about Twig, see the [Twig web page](http://twig.sensiolabs.org).

## Create a blank site {#blank-site}

Using `spress new:site` [command](/docs/2.0/how-is-work/#site-new-command) you
can create a blank site with the following structure:

```
.
├── build
├── composer.json
├── config.yml
└── src
    ├── content
    │   ├── index.html
    │   └── posts
    └── layouts
```

The [new:site command](/docs/2.0/how-is-work/#site-new-command) have an extra 
`--all` option to create a complete scaffolding of the site:

```
.
├── build
├── composer.json
├── config.yml
└── src
    ├── content
    │   ├── index.html
    │   └── posts
    ├── includes
    ├── layouts
    └── plugins
```

## Hierachical layouts {#layouts-inheritance}

Your layouts can inherit from other layouts. Layouts are located at `./src/layouts`
folder.

```
└── layouts
    ├── default.html
    ├── page.html
    └── post.html
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

The `post.html` can inherit from `default.html`:

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

## Reusable content {#reusable-content}

Reusable layout parts are located at `./src/includes` folder.

```
├── includes
│   ├── head.html
│   ├── menu.html
│   ├── nav.html
│   ├── paginator.html
│   ├── post.html
│   ├── posts-list.html
│   └── social-network.html
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
[Twig include statement](http://twig.sensiolabs.org/doc/tags/include.html).

## Plugin installation {#plugin-installation}

You can use [plugins](/add-ons) on your site. To do it, you have to create 
`composer.json` file in your site folder and add the require statement
with the name of the plugin:
 
We will use plugin called `spress/github-metadata-plugin` as an example.
To add it to your site, you simply have to add following changes in your
site `composer.json` and run `composer update` afterwards:

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

Plugin will be available in `_plugins` folder.


## Create a redistributable theme {#redistributable-themes}

Your own themes can be downloaded by other users and used for building their web pages
or as base for new themes. A theme can be installed by downloading it manually, 
using GIT for getting the repository or installed globally with Composer.

To create a distributable package with Composer, you should create a repository
on Github or similar site and register it in [Packagist](https://packagist.org/about) repository.

Example of a [theme](github.com/yosymfony/Spress-theme-spresso/tree/2.0). 
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

### Globally {#install-theme-global}

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
