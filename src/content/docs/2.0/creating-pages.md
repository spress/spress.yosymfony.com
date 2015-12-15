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

## Write pages in Markdown

Spress comes with several different Markdown [converter](/docs/2.0/developers/converters).
