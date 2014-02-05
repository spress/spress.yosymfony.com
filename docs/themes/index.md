---
layout: page-doc
title: Themes
header: { title: Themes }
prettify: true
---
Spress uses the power of Twig for render your templates. You can reusable parts
of your HTML and write your templates with a easy languaje. For more information
about Twig, see the [Twig web page](http://twig.sensiolabs.org).

## Create a site blank

With the `spress site:new` [command](/docs/how-is-work/#site-new-command) you
can create a blank site with the below structure:

```
.
|- composer.json
|- config.yml
|- index.html
|- _layouts/
|- _posts/
```

The command have a extra `--all` option to create a complete scaffolding of the
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
```
{% include 'nav.html' %}
{% include 'widget/email.html' %}
```
{% endverbatim %}

More information about 
[include statement of Twig](http://twig.sensiolabs.org/doc/tags/include.html).

## Plugins installation

You can to use plugins in your site. For to do it, create go to your site folder
and create `composer.json` file and add the following content:

```
{
    "require": {
        "yosymfony/spress-plugin-dataloader": "*"
    },
    "config": {
        "vendor-dir": "_plugins/vendors"
    }
}
```

Next, you run `composer update` command and then you can use the plugin in your site.
The plugins are availables in `_plugins` forlder.

In the previous example, you declare that need the latest version of a plugin called 
`yosymfony/spress-plugin-dataloader`.

## Create a redistributable theme

You can create a redistributable public theme. Somebody can get your theme with 
manually download (a theme is a Spress site) or using 
[Composer](http://getcomposer.org/) tool to install the template in Spress and 
create sites with `spress site:new` [command](/docs/how-is-work/#site-new-command).

For create a distribuible package with Composer, you shuld create a repository
in Github or similar and to register it in [Packagist](https://packagist.org/about) repository.

Example of a [theme](https://github.com/yosymfony/Spress-theme-spresso). 
You can see it in [action](http://yosymfony.github.io/Spress-example/).