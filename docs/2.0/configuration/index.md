---
layout: page-doc-2.0
title: Configuration of a Spress site
description: Each Spress site have a configuration file with information for generating the site
header: { title: Configuration }
prettify: true
---
Your site have a `config.yml` file that let you change the default configuration
of Spress and create new variables that will be accessible in your template with
`{{ "{{ site.your_variable }}" }}`. Some global variables like `timezone` or 
`safe` can be specified in the [command line options or flags](/docs/2.0/how-is-work/#site-build-command).

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
        <div class="col-md-1">
            <i class="fa fa-exclamation-triangle fa-3x color-red"></i>
        </div>
        <div class="col-md-11">
            <p markdown="1">
                The configuration is [YAML](http://yaml.org) file. Do not uses
                tabs.
            </p>
        </div>
    </div>
  </div>
</div>

## Environment configuration: development and production {#environment}

The environment configuration is useful for writing configuration options for development and 
production environments. Each Spress site has a `config.yml` file (mandatory) with the options
for the default environment (dev). If you want set options for production environment you can
to create a `config_prod.yml` file with the options that will be overrided in `config.yml`.
The command line option `--env="prod"` let you to enable the environment.

The pattern for environment configuration filename is `config_{environment-name}.yml`.

An example for production environment:

```
$ spress site:build --env=prod
```

More information and example available at this [blog post](/news/2014/06/12/new-in-spress-1-1-environment-configurations/).

## Default configuration

Spress runs with the default configuration:

```
debug: false

# Reading
env: 'dev'
drafts: false
markdown_ext: ['markdown', 'mkd', 'mkdn', 'md']
text_extensions: [ 'htm', 'html', 'html.twig', 'twig,html', 'js', 'less', 'markdown', 'md', 'mkd', 'mkdn', 'coffee', 'css', 'erb', 'haml', 'handlebars', 'hb', 'ms', 'mustache', 'php', 'rb', 'sass', 'scss', 'slim', 'txt', 'xhtml', 'xml' ]
attribute_syntax: 'yaml'

# Outputting
include: ['.htaccess']
exclude: []
timezone: 'UTC'                          # e.g. Europe/Madrid
safe: false
permalink: 'pretty'
preserve_path_title: false
layout_ext: ['html.twig', 'twig', 'html']
url: ''                                  # e.g: http://your-domain.local:4000

# Collections
collections:
  posts:
    output: true

# Serving
host: '0.0.0.0'
port: 4000
server_watch_ext: ['html', 'htm', 'xml']
```

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>attribute_syntax</td>
            <td>string</td>
            <td markdown="1">
                Format for declaration of attributes at metadata file or [Front-matter](/docs/2.0/front-matter/).
                Values: "yaml" or "json".
            </td>
        </tr>
        <tr>
            <td>collections</td>
            <td>array</td>
            <td>Defines the collections for the content.</td>
        </tr>
        <tr>
            <td>debug</td>
            <td>boolean</td>
            <td>Enables debug mode.</td>
        </tr>
        <tr>
            <td>drafts</td>
            <td>boolean</td>
            <td>Include drafts in the generated site.</td>
        </tr>
        <tr>
            <td>env</td>
            <td>string</td>
            <td>The name of environment.</td>
        </tr>
        <tr>
            <td>exclude</td>
            <td>array</td>
            <td>Force to exclude files or directories.</td>
        </tr>
        <tr>
            <td>include</td>
            <td>array</td>
            <td>Force to include files or directories.</td>
        </tr>
        <tr>
            <td>host</td>
            <td>string</td>
            <td markdown="1">
                Listen at the given hostname. Used with `site:build --server` command.
            </td>
        </tr>
        <tr>
            <td>markdown_ext</td>
            <td>array</td>
            <td>
                For Markdown converter, this is a file extension that
                will be considered as Markdown file.
            </td>
        </tr>
        <tr>
            <td>layout_ext</td>
            <td>array</td>
            <td>
                File extensions that will be considered as layout items.
            </td>
        </tr>
        <tr>
            <td>parsedown_activated</td>
            <td>boolean</td>
            <td markdown="1">
                Activates [Parsedown](http://parsedown.org/) as default Markdown converter instead of
                [Michel Fortin](https://michelf.ca/projects/php-markdown/) converter.
            </td>
        </tr>
        <tr>
            <td>permalink</td>
            <td>string</td>
            <td markdown="1">
                The style of the [permalinks](/docs/2.0/permalinks/).
            </td>
        </tr>
        <tr>
            <td>port</td>
            <td>integer</td>
            <td markdown="1">
                Listen on the given port. Used with `site:build --server` command.
            </td>
        </tr>
        <tr>
            <td>preserve_path_title</td>
            <td>boolean</td>
            <td markdown="1">
                Sets `true` in case of you want to preserve the title extracted
                from the filename path over the title attribute.
                See [issue #47](https://github.com/spress/Spress/issues/47).
            </td>
        </tr>
        <tr>
            <td>safe</span></td>
            <td>boolean</span></td>
            <td>Disable site plugins.</td>
        </tr>
        <tr>
            <td>text_extensions</td>
            <td>array</td>
            <td>File extensions that will be considered as not binary files.</td>
        </tr>
        <tr>
            <td>timezone</td>
            <td>string</td>
            <td markdown="1">
                Set the Timezone. See 
                [more timezones in PHP](http://www.php.net/manual/en/timezones.php).
            </td>
        </tr>
        <tr>
            <td>url</td>
            <td>string</td>
            <td>URL base of your site.</td>
        </tr>
    </tbody>
</table>
