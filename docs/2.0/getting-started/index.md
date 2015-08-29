---
layout: page-doc-2.0
title: Getting started with Spress
description: "Getting started with Spress: setup and create the first site"
header: { title: Docs, sub: Welcome }
prettify: true
---
This guide will cover topics like: 

* creating a site
* writing posts 
* creating a theme

### Requirements {#requirements}

* PHP 5.5 or greater
* [Composer](https://getcomposer.org/)

### Installation {#installation}

The best way to get Spress is to download the PHAR file:

```
$ curl -LOS {{ site.pre_release.url_phar }}
$ chmod +x spress.phar
```

if you want use the executable globally, move it to `/usr/local/bin/`:

```
$ sudo mv spress.phar /usr/local/bin/spress
```

### Quick start

Lets create a sample site and build it. With Spress executable, you have two options:

1. you can scaffold a blank site
2. you can use a base theme

Lets create our site using [Spresso](https://github.com/yosymfony/Spress-theme-spresso/tree/2.0) theme:

**Quick-start**:

```
$ spress new:site /your-site-dir spresso
$ cd /your-site-dir
$ spress site:build --server --watch

# Browse to localhost:4000
```

With `new:site` command Spress creates a new site using Spresso theme. Next,
you can build your site with `site:build` command. You'll get the result at 
`build` folder.

The `--server` option launches a *built-in* server which lets you see your site at `http://localhost:4000`.
`--watch` option tells Spress to watch your files for changes.

### Themes {#themes}

Spresso is the theme base of Spress. See the [Add-ons](/add-ons) page for more themes and plugins.

