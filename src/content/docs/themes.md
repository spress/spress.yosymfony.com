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
Themes brings to Spress the mechanic to create sites based on
[community-maintained templates](/add-ons/themes/). Typically, themes package
layouts, includes and assets in a way that can be overridden by your site
content. Themes are located in `src/themes/`. Spress relies on
[Packgist](https://packagist.org/) as themes repository.

The structure of directories for themes are the following:

```
|- src/
|  |- themes
|  |  |- theme01/
|  |  |- theme02/
```

A site could contains at least one theme. **A theme is basically a site**:

```
|- themes/
|  |- theme01
|  |  |- src/
|  |  |  |- layouts/
|  |  |  |- includes/
|  |  |  |- content/
|  |  |  |  |- assets/
|  |  |- config.yml
|  |  |- README.md
|  |  |- screenshot.png
```
The `README.md` and `screenshot.png` files are optionals but it's recommendable
those one are present. The former contains information of the theme such as
a briefly description, how to use... etc. The latter provides an idea about the
look of the theme.

## How to install a theme?

There are two ways to install themes on your site: adds the theme manually to
the `composer.json` and then performs an `update:plugin` command or uses the
all-in-one `add:plugin` command:

```bash
$ cd your-site-directory
$ spress add:plugin spress-add-ons/clean-blog-theme
```

After installing a theme, it's necessary to enable this one in the
`config.yml` file: add or edit the file with the following:

```yaml
themes:
  name: 'spress-add-ons/clean-blog-theme'
```

## Creating a new theme

The [new:theme](/docs/how-it-works/#new-theme) command let you create a blank
theme or one based on a preexisting theme.

Creating a blank theme at `my-theme` folder:

```
$ spress new:theme my-theme
```

Creating a theme based on the latest version of
[Clean blog theme](https://github.com/spress-add-ons/Clean-blog-theme):

```
$ spress new:theme my-theme spress-add-ons/clean-blog-theme
```
## How the themes work?

Spress will look first to your site’s content, before looking to the theme’s
defaults for any requested file in the following folders:

* layouts
* includes
* content/assets

An example using layouts. suppose the following scenario:

```
src
|- themes/
|  |- theme01
|  |  |- src/
|  |  |  |- layouts/
|  |  |  |  |- default.html
|- layouts
|- ...
|- content
|  |- index.html
```

The front matter block of the `index.html` is:

```yaml
layout: default
```

In this case, when the renderizer finds out the layout, first looks for
`default.html` file in the `layouts` folder of your site. As in this example there is
not a `default.html` file in that place, the renderizer will looks for
the file at `theme01/src/layouts`.

### Layouts {#layouts-inheritance}

Layouts describes how the content is distributed in a page. Layouts are simple
HTML & Twig files located at `layouts` folder and they can inherit from other
layouts

In this example, `default.html` file may hold the general HTML definitions
like `html` and `head` tags with metas, title and assets:

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

### Reusable content (partials) {#reusable-content}

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

### Stylesheets

Your theme’s styles can be included in the site stylesheet using the  CSS `@import` directive.

An example. Suppose the following scenario:

```
|- src/
|  |- themes
|  |  |- theme01
|  |  |  |- src
|  |  |  |  |- content
|  |  |  |  |  |- assets
|  |  |  |  |  |  |- bootstrap.min.css
```

You can create your site CSS style in `src/content/assets/style.css` based on
the `bootstrap.min.css` file from the current theme:

```
@import "bootstrap.min.css";

#my-style {
    background-color: #eee;
}
```

### Avoids renderizer in some files {#avoid-renderizer}

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

#### Avoids renderizer for type of files

There is a way to avoid the renderizer action over entire directories
as well as file types using the `avoid_renderizer` option in `config.yml` file.
Spress come with the follow default configuration:

```yaml
avoid_renderizer:
  filename_extensions: ['css', 'js']
  paths: ['assets', 'bower_components', 'node_modules']
```

* **filename_extensions**: list of filename's extension in which the renderizer
will not act.
* **paths**: list of paths relatives to `content` folder in which the renderizer
will not act.

If you want to change the default configuration, open your `config.yml` file
and copy the previous block into this one and modify it with your own values.

## How to create a site based on a theme?

To create a site based on a theme you just need to perform a `new:site` command.
See [Create a new site](/docs/how-it-works/#new-site-command) section of
[how it work](/docs/how-it-works/) page.

### Creating a theme vs creating a site based on a theme

When you create a theme, you are scaffolding a new blank site. But if you create
a new site you are scaffolding a new blank site and set the theme package as a
requirement of your site in `composer.json` file.

## Publishing your theme

Themes are published via [Packagist.org](https://packagist.org/). It is a repository of
packages for PHP. In order to publish a theme, you will need an account which you can
create for free using a Github's account or filling out a form. Additionally, you
need a Git repository of your theme.

1. Modify the `composer.json` with the metadata of your theme:
```
{
    "name": "vendor/the-name-of-my-theme",
    "description": "The description of my theme",
    "keywords": ["spress", "theme"]
}
```
2. Create a Git repository:
```
git init # Only the first time
git add -A
git commit -m "Init commit"
```
3. [Submit your theme to Packagist](https://packagist.org/packages/submit).
