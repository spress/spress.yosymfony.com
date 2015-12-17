---
layout: page-doc-2.0
title: Attributes
header:
  title: Attributes
menu:
  id: doc 2.0
  title: Attributes
  order: 5
prettify: true
---
## Front matter {#front-matter}

Front matter block lets you specify certain attributes of a page or create custom ones
of your own that will be available in the content as variables. 

**The Front matter must be the first thing in the file**.

```
---
layout: default
title: "Hello world" # Replace the posts title from the file.
my_name: "Victor"
---
This is a page body.
```

The Front matter uses [YAML](http://yaml.org) syntax and is declared between triple-dashed lines.
Your attributes will be accessible for Twig: `My name is {{ "{{ page.my_name }}" }}`.

There are atributes like `layout` or `permalink` that have a special meaning.

## Metadata files {#metadata-files}

There are situations in where a Front matter breaks syntax highlighting of your IDE. For those situations
a metadata file lets you specify the page's attributes in a separate file. A metadata file uses YAML
syntax and has the same name as the page itself but with `.meta` suffix. e.g: the page `about.md` can have
its attributes stored at `about.md.meta`.
