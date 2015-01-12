---
layout: page-doc
title: Getting started with Spress
description: "Getting started with Spress: setup and creates the first site"
header: { title: Docs, sub: Welcome }
prettify: true
---
This guie will cover topics like create a site, write a post or create a theme.

### Requirement
* PHP 5.4 or great.

### Installation
The best way to get Spress is to download the PHAR file:

```
$ curl -OS {{ site.release.url_phar }}
$ chmod +x spress.phar
```

if you want use the executable globally, move it to `/usr/local/bin/`:

```
$ sudo mv spress.phar /usr/local/bin/spress
```

### Starting
You need create a site and build it. With Spress executable, you can create a 
site blank or using a base theme and next build your site. 

**Quick-start**:

```
$ spress site:new /your-site-dir spresso
$ cd /your-site-dir
$ spress site:build --server --watch

# Browse to localhost:4000
```

With `site:new` command you create a new site using Spresso theme. Next,
you can build your site with `site:build` command. You'll get the result in 
`_site` dir.

The `--server` option launches a *built-in* server which lets you see your site from `localhost:4000`.
`--watch` option tells Spress to watch your files for changes.

### Themes

Spresso is the theme base of Spress. See the [Add-ons](/add-ons) page for getting themes and plugins.

