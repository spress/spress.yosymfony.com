---
layout: page-doc-2.0
title: Taxonomies
description: Collections allow you to define a new type of content
header:
  title: Taxonomies
menu:
  id: doc 2.0
  title: Taxonomies
  order: 11
prettify: true
---
Taxonomy is a way to group things together. The taxonomy [generator](/docs/developers/generators)
lets you group some items around a term. This generator uses **[pagination generator](/docs/pagination)** 
for generating multiple pages for each term.

The following example assume that you are using a site with Spresso theme. If not, you
can create one with `new:site` command:

```
$ spress new:site example spresso
```
An example of how to use the taxonomy generator can be found at `./src/content/categories/index.html`.
Its content is simitar to below:

{% verbatim %}
```
---
layout: "page"

generator: "taxonomy"
max_page: 5
taxonomy_attribute: "categories"
permalink: "/:name"
---
<div class="page-header">
    <h1>{{ page.term }} <small>category</small></h1>
</div>

{% if page.list_mode %}
    {% include "posts-list.html" with { posts: page.pagination.items } %}
{% endif %}

{% include "paginator.html" %}
```
{% endverbatim %}

* `taxonomy_attribute`: the name of the attribute that contains the list of terms or taxons. `categories` is the default value.
* `permalink`: permalink style for each page of a term. `/:name` is the default value.

`pagination_permalink` attribute lets you configure the permalink sytle for the multiple pages of a term. `/page:num` is the default value.
