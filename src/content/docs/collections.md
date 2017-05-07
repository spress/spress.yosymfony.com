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

**Predefined collections** are: `posts` and `pages`. The first collection is
assigned to items located at `./src/content/posts`.

## How to configure?

Add the following to your `config.yml`:

```yaml
collections:
  posts:
    output: true
    sort_by: 'date'
    sort_type: 'descending'

  projects:
    output: true
    title: "A project of my company"
```
The prior example adds a new collections called projects. Next add a new folder with the same name
at your content folder: `./src/content/projects`. The items located at the `project` folder belong
to `projects` collection.

### Attributes with special meaning:

**output**: `true` for writing the rendered content to the output system, normally a file.

#### Sort items of a collection {#sort-items}

<span class="label label-success">Spress >= 2.1</span>

Items of a collection can be sorted with two new attributes with special meaning:

* **sort_by**: the name of the attribute used as criteria to sort.
* **sort_type**: values accepted: `ascending` or `descending`, last one by default.

At the prior example, `posts` collection is sorted by the `date` attribute of each item
belonging to the collection with a `descending` type. The items of `projects` collection
aren't in any given order.

Items of `posts` collection are sorted by descending using `date` attribute as criteria by default.
Variables [`site.categories`](/docs/variables/#site-variables) and [`site.tags`](/docs/variables/#site-variables) are affected by posts sorting.

### Default attributes

Default attributes can be set for a collection. e.g: `title`. Item's attributes overrides
the collection's default attributes.

#### How to default the layout attribute for pages?
Let's go to set the default layout for pages to `page`:

```
collections:
  posts:
    output: true
    sort_by: 'date'
    sort_type: 'descending'
  pages:
    layout: 'page'
```

**Notices** that asset files such as `CSS` or `Javascript` belong to `pages` collection
and they receive the `layout` attribute though it does not take affect thanks to
[avoid-renderizer](/docs/themes/#avoid-renderizer-type) option.

## How to access?

Items of `projects` collections are available at `site.projects`. Each item has an attribute
`collection` with the name of the collection.

Data about `projects` collection are located at `site.collections.projects`. More information about
[variables available for registered collection](/docs/variables/#collection-variables).

### An example

The example below assume that a collection `projects` exists and each item of that collection has
`title` and `description` attributes.

{% verbatim %}
```
---
layout: page
title: 'My projects'
---
<div class="page-header">
    <h1>My <small>projects</small></h1>
</div>
<div class="row">
	{% for project in site.projects %}
		<div class="col-md-4 project-box">
			<div class="panel panel-default">
				<div class="panel-body">
					<h2><a href="{{ project.url }}">{{ project.title }}</a></h2>
					<p>{{ project.description }}</p>
				</div>
			</div>
		</div>
	{% endfor %}
</div>
```
{% endverbatim %}

Here's an example of what this structure might look like:

```
./src
|- /content
|  |- /projects
|  |  |- my-awesonme-web.md
|  |  |- my-library.md
```

### Relationships: Next and prior items {#relationships}

<span class="label label-success">Spress >= 2.1</span>

Spress adds `prior` and `next` relationships to each item belonging to a sorted collection
referring to previous and next items in said collection.

The below snippet of code could be inserted in the layout template applied to posts for exposing the prior
and next posts related to current post.

{% verbatim %}
```
<ul>
    {% for rel in page.relationships.next %}
        <li>Next: <a href="{{ rel.url }}">{{ rel.title }}</a></li>
    {% endfor %}
    {% for rel in page.relationships.prior %}
        <li>Prior: <a href="{{ rel.url }}">{{ rel.title }}</a></li>
    {% endfor %}
</ul>
```
{% endverbatim %}

The attributes exposed by each item of a relationship are the same than a regular item.
New relationships can be added by [plugins](/docs/developers/data-sources/#relationships).
