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
for generating multiple pages for each term. This means that pagination generator's attributes
are available with the taxonomy generator.

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
list_mode: true
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
{% else %}
    {% for post in page.pagination.items %}
        {% include "post.html" %}
    {% endfor %}
{% endif %}

{% include "paginator.html" %}
```
{% endverbatim %}

Attributes:

* `taxonomy_attribute`: the name of the attribute that contains the list of terms or taxons. `categories` is the default value.
* `permalink`: permalink style for each page of a term. `/:name` is the default value.

The `pagination_permalink` attribute lets you configure the permalink sytle for the multiple pages of a term. `/page:num` is the default value.

## Permalinks

Taxonomy generator adds an attribute `terms_url` to each item processed with the permalinks of the terms.
The following example show you how to write the categories of a post assuming the value of `taxonomy_attribute`
attribute is `categories`. Each element of `page.terms_url.categories` has the categorie's name as a key and the
permalink as value:

{% verbatim %}
```
{% if page.terms_url.categories | length > 0 %}
	{% for category, url in page.terms_url.categories %}
	    <a href="{{ url }}">{{ category }}</a>
	    {% if loop.last == false %},{% endif %} 
	{% endfor %}
{% endif %}
```
{% endverbatim %}
