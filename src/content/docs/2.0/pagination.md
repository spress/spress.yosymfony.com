---
layout: page-doc-2.0
title: Pagination
header:
  title: Pagination
menu:
  id: doc 2.0
  title: Pagination
  order: 10
prettify: true
---
Items can be organized in pages thanks to pagination [generator](/docs/2.0/developers/generators)
and will be accessible with URLs like `/blog/page2/`.

The following examples assume that you are using a site with Spresso theme. If not, you
can create one with `new:site` command:

```
$ spress new:site example spresso
```

The simple way of add pagination to `posts` [collection](/docs/2.0/collections) items is creating a
`index.html` file at `./src/content/blog` with the following content:

{% verbatim %}
```
---
layout: "page"
title: "Blog posts"

generator: "pagination"
provider: "site.posts"
max_page: 1
sort_by: "date"
---
<h1>Posts</h1>
<ul>
    {% for post in page.pagination.items %}
        <li><a href="{{ post.url }}">{{ post.title }}</a></li>
    {% endfor %}
</ul>

{% include "paginator.html" %}
```
{% endverbatim %}

* `generator`: contains the name of the generator, in this case `pagination`.
* `provier`: The descriptor for the provider of the items (collection) to be paginated.
`site.posts` is the default value. If you have a custom collection, for example `events`, this value
would be`site.events`.
* `max_page`: The maximum number of item per page. Default value is `5`.

Recompile your site and your page will be accesible at `http://localhost:4000/blog/`.

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
            <td>/blog/index.html</td>
            <td>/blog/</td>
        </tr>
        <tr>
            <td>2</td>
            <td>/blog/page2/index.html</td>
            <td>/blog/page2/</td>
        </tr>
        <tr>
            <td>n</td>
            <td markdown="1">/blog/page**n**/index.html</td>
            <td markdown="1">/blog/page**n**/</td>
        </tr>
    </tbody>
</table>

## Sorting items

With `sort_by` and `sort_type` attributes you will be able to control how items are sorted at pagination generator.
`sort_type` only supports `ascending` and `descending` values. `descending` is the default behavior. `sort_by` attribute
contains the name of the attribute used as criteria to sort.

Open the `./src/content/blog/index.html` file and add `sort_type: "ascending"` attribute at Front matter block. Then, 
recompile your site. Posts at `http://localhost:4000/blog/` should be in reverse order.

## Page permalink

The default permalink for each generated page is `/page:num`. The `:num` placeholder will be replaced
with the number of page starting with 2.
