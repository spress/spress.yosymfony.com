---
layout: page-doc-2.0
title: Collections
description: Collections allow you to define a new type of content
header:
  title: Collections
menu:
  id: doc 2.0
  title: Collections
  order: 6
prettify: true
---
Prior to Spress 2, the only available types of content were `post` and `page`.
With the second mayor version of Spress we introduce collections. Collections
allow you to define a new type of content that behave like pages or posts.

**Predefined collections** are: `post` and `pages`. The first collection is
assigned to items located at `./src/content/posts`.

## How to configure

Add the following to your `config.yml`:

```yaml
collections:
  post:
    output: true

  projects:
    output: true
    title: "A project of my company"
```
The prior example adds a new collections called projects. Next add a new folder with the same name 
at your content folder: `./src/content/projects`. The items located at the `project` folder belong 
to `projects` collection.

### Attributes with special meaning:

**output**: `true` for writing the rendered content to the output system, normally a file.

### Default attributes
Default attributes can be set for a collection. e.g: `title`. Item's attributes overrides
the collection's default attributes.

### How to access?

Items of `projects` collections are available at `site.projects`. Each item has an attribute
`collection` with the name of the collection.

Data about `projects` collection at `site.collections.projects`. More information about
[variables available for registered collection](/docs/2.0/variables/#collection-variables).