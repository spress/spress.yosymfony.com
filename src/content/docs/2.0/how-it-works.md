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
transforms it to final HTML ready to deploy on your hosting. By default, your
content is generated at `build` folder. You can create content using HTML or 
Markdown syntax. Additionally with [converters](/docs/2.0/developers/converters) you 
can add new types of content.

## Site structure {#site-structure}
This is the typical structure. The only mandatory file is `config.yml`.

```
.
├── build
├── src
│   ├── includes
│   └── layouts
│   ├── content
│   │   ├── posts
│   │   │   ├── 2015-08-16-my-post.md
│   │   ├── index.html
│   │   ├── ...
├── composer.json
└── config.yml
```
* **config.yml**: Contains the configuration data. You can change the behaviour of 
Spress or create custom variables.
* **./src/includes**: Contains partials that can be used in the layouts, pages and posts.
* **./src/layouts**: Contains layout files used to organize your content. In your post or page, 
you can choose the layout in the [Front-matter](/docs/2.0/attributes/#front-matter):

```
---
layout: post
---
```
* **./src/content**: Contains the content of your site.
* **./src/content/posts**: Contains the blog posts files. Files located at this folder
are under `posts` collection  and they have a special name format: `year-month-day-title.md`.
The Front-matter of each file let you change these properties:

```
---
layout: post
title: "Hello world"
date: "2013-01-01"
---
```
* **./src/plugins**: Extends the functionality of Spress. See [developers docs](/docs/2.0/developers).
* **./build**: This is where the generated site will be placed.

## Page example {#page-example}

Below is an example of a simple HTML page:

```
---
layout: default
name: "John"
email: "john@example.com"
---
<address>
  <strong>{{ "{{ page.name }}" }}</strong><br/>
  <a href="mailto:{{ "{{ page.email }}" }}">{{ "{{ page.email }}" }}</a>
</address>
```
The block delimited by triple-dashed lines is the Front-matter and uses 
[YAML](http://yaml.org) syntax. Inside it you can create a custom variables
that are available in page content with Twig syntax: 
`{{ "{{ page.your-variable-name }}" }}`.

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
        <div class="col-md-1">
            <i class="fa fa-bookmark-o fa-3x"></i>
        </div>
        <div class="col-md-11">
            <p markdown="1">
                Spress uses [Twig](http://twig.sensiolabs.org/) as default [renderizer](/docs/2.0/developers/renderizer)
                (template engine). See its documentations to get more powerful
                templates.
            </p>
        </div>
    </div>
  </div>
</div>

## Post example

This is a post with "post" layout assigned:

```
---
layout: post
---
Hello. This is a post.
```

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
        <div class="col-md-1">
            <i class="fa fa-bookmark-o fa-3x"></i>
        </div>
        <div class="col-md-11">
            <p markdown="1">
                **[PHP-Markdown by Michael Fortin](http://michelf.ca/projects/php-markdown/reference/)** 
                is the default Markdown engine. Spress comes with another Markdown engine called 
                **[Parsedown by Emanuil Rusev](http://parsedown.org/)** that contains several optimizations
                over Michael Fortin implementation. To enable Parsedown instead of PHP-Markdown
                open the `config.yml` file at your site and add the following line: `parsedown_activated: true`.
            </p>
        </div>
    </div>
  </div>
</div>

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

# Build site and watch for changes (regenerated automatically into ./_site)
$ cd /your-site-dir
$ spress site:build --watch

# Build site using specific timezone:
$ spress site:build -s /your-site-dir --timezone="Europe/Madrid"

# Build site using production environment:
$ spress site:build --env=prod

# Build site with plugins disabled:
$ spress site:build --safe
```

### new:site {#site-new-command}

Create a new site. 

`new:site [path[="./"]] [template[="blank"]] [--force] [--all]`

* `template` Set the template for the site. Spresso is a built-in theme.
* `--force` Force to use the path even though it exists and it's not empty.
* `--all` In blank template, creates the complete scaffold.

E.g `$ spress new:site /your-site-dir spresso`

The prior example creates a new site using [Spresso theme](https://github.com/yosymfony/Spress-theme-spresso/tree/2.0).

### new:post

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

### self-update

`self-update` or `selfupdate` command replace your `spress.phar` by the latest version.
