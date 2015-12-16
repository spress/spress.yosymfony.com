---
layout: page-doc-2.0
title: Creating pages
header:
  title: Creating pages
menu:
  id: doc 2.0
  title: Creating pages
  order: 7
prettify: true
---
The following examples assume that you are using a site with Spresso theme. If not, you
can create one with `spress new:site example spresso`.

The simple way of add a page is creating a `welcome.html` file at `./src/content`.

{% verbatim %}
```
---
name: "My personal site"
---

<h1>Welcome to {{ page.name }}</h1>

```
{% endverbatim %}

Recompile your site with `spress site:build --server` and your page will be accesible
at `http://localhost:4000/welcome/`. The physical path of that page is `./build/welcome/index.html`.

The `index.html` file in a folder, by convection, is the default page unless
your server was configured to look other default filename.

If you don't like having a [Front matter block](/docs/2.0/attributes/) at the top of every page, you can put
your attributes in a [metadata file](/docs/2.0/attributes/#metadata-files).

## Customize the layout

Layouts are files, tipically written using HTML & Twig syntax, that defines the look and feel of a site
and are located at `.src/layouts/`. The layout of a page is specified by `layout` attribute:

{% verbatim %}
```
---
layout: "page"
name: "My personal site"
---

<h1>Welcome to {{ page.name }}</h1>

```
{% endverbatim %}

## Customize the permalink

Permalinks are constructed by creating a template URL like `/:path/:basename.:extension`.
Permalinks can be specified globally at `config.yml` file of your site or at item level as
an attribute. Open the `./src/content/welcome.html` file and add `permalink` attribute in the
Front matter block:

{% verbatim %}
```
---
permalink: "welcome-page.html"
layout: "page"
name: "My personal site"
---

<h1>Welcome to {{ page.name }}</h1>

```
{% endverbatim %}

Recompile your site and your page will be accesible at `http://localhost:4000/welcome-page.html`.

More details about [how Spress treats the permalinks](/docs/2.0/permalinks).

## Write pages in Markdown

**[PHP-Markdown by Michael Fortin](http://michelf.ca/projects/php-markdown/reference/)** 
is the default Markdown [converter](/docs/2.0/developers/converters). Spress comes with another Markdown converter called 
**[Parsedown by Emanuil Rusev](http://parsedown.org/)** that contains several optimizations
over Michael Fortin implementation. To enable Parsedown instead of PHP-Markdown
open the `config.yml` file of your site and add the following line: `parsedown_activated: true`.

Continuing with prior example, open the `./src/content/welcome.html` file and replace its content with
Markdown:

{% verbatim %}
```
---
layout: "page"
name: "My personal site"
---

Welcome to {{ page.name }}
--------------------------
**[Markdown](https://en.wikipedia.org/wiki/Markdown)** is a *lightweight
markup language* with plain text formatting syntax designed so that it
can be converted to HTML and many other formats using a tool by the same
name.
```
{% endverbatim %}

Rename the file to `./src/content/welcome.md` and recompile the site. The file extensions
considered as Markdown are `markdown`, `mkd`, `mkdn` and `md`.