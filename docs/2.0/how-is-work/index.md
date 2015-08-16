---
layout: page-doc-2.0
title: How is work?
description: How an static site generator work
header: { title: How is work? }
prettify: true
---
Spress is a static site generator, an application that take your site and 
transform to final HTML ready to deploy in your hosting. By default, your
content is generated in `build` directory. You can create content using HTML or 
Markdown syntax. Additionaly with [converters](/docs/developers/converters) you 
can add new type of content.

## Site structure
This is the typical structure. The only mandatory file is `config.yml`.

```
.
|- build
|- src
|- |- includes
|- |- layouts
|- |- content
|- |- |- posts
|- |- |- |- 20150816-my-post.md
|- |- |- index.html
|- |- |- ...
|- config.yml
|- composer.json
```
* **config.yml**: Store the configuration data. You can change the behaviour of 
Spress or create custom variables.
* **src/includes**: There is a partials that can be used in the layouts, pages and posts.
* **src/layouts**: The layout files organize your content. In your post or page, 
you can choose the layout in the [Front-matter](/docs/front-matter):

```
---
layout: post
---
```
* **src/content/posts**: Store the blog posts files (if you want create a blog). The files
have a special name format: `year-month-day-title.md`. In the Front-matter you 
can change this properties:

```
---
layout: post
title: "Hello world"
date: "2013-01-01"
---
```
* **src/plugins**: Extends the functionality of Spress. See [developers docs](/docs/developers).
* **build**: This is where the generated site will be placed.

The directories that start with underscore are considered special directories and
they not will be copied to generated site.

## Page example
Below a example of a simple HTML page:

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
that can be accessible to you using Twig syntax: 
`{{ "{{ page.your-variable-name }}" }}`.

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
        <div class="col-md-1">
            <i class="fa fa-bookmark-o fa-3x"></i>
        </div>
        <div class="col-md-11">
            <p markdown="1">
                Spress uses [Twig](http://twig.sensiolabs.org/) as template
                engine. See its documentations for get more powerful
                templates.
            </p>
        </div>
    </div>
  </div>
</div>

## Post example
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
                is the default Markdown engine. Spress uses 
                [Markdown extra flavour](http://michelf.ca/projects/php-markdown/extra/) for 
                more rich Markdown.
            </p>
        </div>
    </div>
  </div>
</div>

## Spress commands

### new:site {#site-new-command}

Create a new site. 

`new:site [path[="./"]] [template[="blank"]] [--force] [--all]`

* `template` Set the template for the site. Spresso is a built-in theme.
* `--force` Force to use the path even though exists and it's not empty.
* `--all` In blank template, creates the complete scaffold.

E.g `$ spress new:site /your-site-dir spresso`

The prior example creates a new site using [Spresso theme](https://github.com/yosymfony/Spress-theme-spresso/).

### site:build {#site-build-command}
Build your site in your configured destination, typically `_site`. 

`site:build [-s|--source="./"] [--timezone="..."] [--env="dev"] [--server] [--watch] [--drafts] [--safe]`

* `--timezone` Set the timezone. E.g: "Europe/Madrid".
[More timezones](http://www.php.net/manual/en/timezones.php).
* `--env` Set the environment name [More information](/docs/configuration/#environment).
* `--server`The built-in server will run by default at `http://localhost:4000`.
* `--watch` Watch for changes and regenerate your site automatically.
* `--drafts` Include the draft post in the transformation.
* `--safe` Disable all plugins.

```
# Build source path:
$ spress site:build -s /your-site-dir

# Build default dir:
$ cd /your-site-dir
$ spress site:build

# Built-in server and watch for changes
$ cd /your-site-dir
$ spress site:build --server --watch  # Go to http://localhost:4000

# Only watch for changes an generate your site automatically into ./_site
$ cd /your-site-dir
$ spress site:build --watch

# Using timezone:
$ spress site:build -s /your-site-dir --timezone="Europe/Madrid"

# Using production environment:
$ spress site:build --env=prod

# Plugins disabled:
$ spress site:build --safe
```

#### The output command:

```
Starting...
Total posts: 0
Processed posts: 0
Drafts post: 0
Total pages: 17
Processed pages: 10
Other resources: 5
```

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-3">Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total posts</td>
            <td>Number of posts found at posts directory.</td>
        </tr>
        <tr>
            <td>Processed posts</td>
            <td>Number of posts with Front-matter.</td>
        </tr>
        <tr>
            <td>Total pages</td>
            <td markdown="1">
                Number of pages found at your site.
                **What's considered a page?** 
                Any file with extension registered in `processable_ext` key at the
                configuration file or registered by a converters.
            </td>
        </tr>
        <tr>
            <td>Processed pages</td>
            <td>Number of pages with Front-matter.</td>
        </tr>
        <tr>
            <td>Others resources</td>
            <td>
                Others files not procesable that will be verbatim copied
                to the generated site.
            </td>
        </tr>
    </tbody>
</table>
