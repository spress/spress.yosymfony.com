---
layout: blog/post
title: How to get the categories of your posts?
description: We explain to you how to get the categories of your posts
categories: [resources]
tags: [snippet]
---
This is a simple *snippet* that explain to you how the get your posts' categories. Similar
way for getting the tags of your posts:

{% verbatim %}
```
---
layout: default
title: Categories
---
{% for categorie, posts in site.categories %}
    <h3>{{ categorie }}</h3>
    
    {% for post in posts %}
        <p>
            <b>{{ post.title }}</b>
            <p>{{ post.content }}</p>
        </p>
    {% endfor %}
{% endfor %}
```
{% endverbatim %}

Each element inside `site.categories` is a [page](/docs/variables#page-variables) element.