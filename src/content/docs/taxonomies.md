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
* `permalink`: permalink style for each page of a term. `/:name` is the default value. This permalink is relative
to the folter in where generator was defined, in this case, `categories` folder and that means URLs generated starting
by `/categories`.

The `pagination_permalink` attribute lets you configure the permalink sytle (relative to the term's permalink)
for the multiple pages of a term. `/page:num` is the default value.

Recompile your site and your categories will be accesible at `http://localhost:4000/categories/`.

Files generated:

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Page</th>
            <th>File</th>
            <th>URL</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>/categories/term1/index.html</td>
            <td>/categories/term1/</td>
        </tr>
        <tr>
            <td>2</td>
            <td>/categories/term1/page2/index.html</td>
            <td>/categories/term1/page2/</td>
        </tr>
        <tr>
            <td>n</td>
            <td markdown="1">/categories/term1/page**n**/index.html</td>
            <td markdown="1">/categories/term1/page**n**/</td>
        </tr>
    </tbody>
</table>

**Notice:** variables `site.tags` and `site.categories` are special variables that contains items of `posts` collection
organized by tags and categories regardless of taxonomy generator.

## Permalink to terms {#permalink-to-term}

**Taxonomy generator adds an attribute `terms_url` to each item processed with the permalinks of the terms**.
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

### Example of an index category page {#index-category-page}

Sometime, you could need a page for listing out all categories registered. The following snippet
of code can be used for that purpose:

{% verbatim %}
```
{% set categoryList = [] %}
<ul>
{% for category in site.categories %}
  {% for item in category %}
    {% for categoryName, categoryUrl in item.terms_url.categories %}
      {% if categoryName not in categoryList | keys %}
        {% set categoryList = categoryList | merge({ (categoryName) : categoryUrl }) %}

        <li><a href="{{ categoryUrl }}">{{ categoryName }}</a></li>
      {% endif %}
    {% endfor %}
  {% endfor %}
    
{% endfor %}
</ul>
```
{% endverbatim %}
