---
layout: page-doc-2.0
title: How it works?
description: How a static site generator works
header:
  title: How it works?
menu:
  id: doc 2.0
  title: How it works?
  order: 2
prettify: true
---
Spress is a static site generator - an application that takes your site and 
transforms it to final HTML ready to deploy on your hosting. Your content is
generated at `build` folder. You can create content using HTML or 
Markdown syntax. Additionally, with [converters](/docs/2.0/developers/converters), you 
can add new types of content.

## Site structure {#site-structure}

This is the typical structure of a Spress site

```
.
├── build
├── src
│   ├── content
│   │   ├── posts
│   │   │   ├── 2015-08-16-my-post.md
│   │   ├── index.html
│   │   ├── ...
│   ├── includes
│   ├── layouts
│   ├─- plugins
├── composer.json
└── config.yml
```
* **config.yml**: Contains the configuration data. You can change the behaviour of 
Spress or create custom variables.
* **./src/includes**: Contains partials that can be used in the layouts, pages and posts.
* **./src/layouts**: Contains layout files used to organize your content. In your post or page, 
you can choose the layout in the [Front matter](/docs/2.0/attributes/#front-matter):
* **./src/content**: The main content of your site are located in this folder.
* **./src/content/posts**: Contains the blog posts files. Files located at this folder
are under `posts` [collection](docs/2.0/collections) and they have a special name format: `year-month-day-title.md`.
The Front matter of each file let you change these properties.
* **./src/plugins**: Extends the functionality of Spress. See [developers docs](/docs/2.0/developers).
* **./build**: This is where the generated site will be placed.

## A page example {#page-example}

Below is an example of a simple page written using Markdown:

{% verbatim %}
```
---
layout: default
name: "John"
---
Welcome {{ page.name }}
-----------------------

This is an example page.
```
{% endverbatim %}

The block delimited by triple-dashed lines is the Front matter and uses [YAML](http://yaml.org) syntax.
Inside it you can create custom [attributes](/docs/2.0/attributes) that are available as variables in page
content with Twig syntax: `{{ "{{ page.your-variable-name }}" }}`.

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
        <div class="col-md-1">
            <i class="fa fa-bookmark-o fa-3x"></i>
        </div>
        <div class="col-md-11">
            <p markdown="1">
                Spress uses [Twig](http://twig.sensiolabs.org/) as default [renderizer](/docs/2.0/developers/renderizer)
                (template engine). See its documentation to get more powerful
                templates.
            </p>
        </div>
    </div>
  </div>
</div>

### Pretty URLs

Spress has the ability to generate friendly URL’s by converting files like `welcome.md` to `/welcome/index.html`.
See [permalink](/docs/2.0/permalinks) documentation.

## Spress commands {#spress-commands}

### site:build {#site-build-command}

Build your site in your `build` folder. 

`site:build [-s|--source="./"] [--timezone="..."] [--env="dev"] [--server] [--watch] [--drafts] [--safe]`

* `--timezone` Set the timezone. E.g: "Europe/Madrid".
[More timezones](http://www.php.net/manual/en/timezones.php).
* `--env` Set the environment name [More information](/docs/2.0/configuration/#environment).
* `--server` The built-in server will run by default at `http://localhost:4000`.
* `--watch` Watch for changes and regenerate your site automatically.
* `--drafts` Include the draft post in the transformation.
* `--safe` Disable all plugins.

```
# Build site with source path defined:
$ spress site:build -s /your-site-dir

# Build site with default dir:
$ cd /your-site-dir
$ spress site:build

# Build site and run built-in server and watch for file changes
$ cd /your-site-dir
$ spress site:build --server --watch  # Go to http://localhost:4000

# Build site and watch for changes (regenerated automatically into ./build)
$ cd /your-site-dir
$ spress site:build --watch

# Build site using specific timezone:
$ spress site:build -s /your-site-dir --timezone="Europe/Madrid"

# Build site using production environment:
$ spress site:build --env=prod

# Build site with plugins disabled:
$ spress site:build --safe
```

### new:site {#new-site-command}

Create a new site. 

`new:site [path[="./"]] [template[="blank"]] [--force] [--all]`

* `template` Set the template for the site. Spresso is a built-in theme.
* `--force` Force to use the path even though it exists and it's not empty.
* `--all` In blank template, creates the complete scaffold.

E.g `$ spress new:site /your-site-dir spresso`

The prior example creates a new site using [Spresso theme](https://github.com/yosymfony/Spress-theme-spresso/tree/2.0).

### new:post {#new-post}

The `new:post` command helps you generates new posts.
By default, the command interacts with the developer to tweak the generation.
Any passed option will be used as a default value for the interaction.

```bash
new:post  [--title="..."] [--layout="default"] [--date="..."]
      [--tags="..."] [--categories="..."]`
```
* `--title`: The title of the post.
* `--layout`: The layout of the post.
* `--date`: The date assigned to the post.
* `--tags`: Comma separated list of tags.
* `--categories`: Comma separated list of categories.

### new:plugin

Crate a new plugin. See the documentation at [developers doc](/docs/2.0/developers).

### self-update

`self-update` or `selfupdate` command replace your `spress.phar` by the latest version.
