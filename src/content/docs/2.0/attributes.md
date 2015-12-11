---
layout: page-doc-2.0
title: Attributes
header:
  title: Attributes
  sub: front matter and metadata files
menu:
  id: doc 2.0
  title: Attributes
  order: 5
prettify: true
---

## Front matter {#front-matter}
Front-matter block lets you specify certain attributes of the page 
and define new variables that will be available in the content. 

**The Front matter must be the first thing in the file**.

```
---
layout: default
title: "Hello world" # Replace the posts title from the file.
my_name: "Victor"
---
This is a post body.
```

The Front matter uses [YAML](http://yaml.org) syntax. Your new variables will
be accessible for Twig: `My name is {{ "{{ page.my_name }}" }}`. 

Only the proccessable files with Front-matter block will be treated as special file.
A empty Front-matter is valid:

```
---
---
This is a post.
```

## Metadata files