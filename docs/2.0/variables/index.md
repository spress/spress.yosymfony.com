---
layout: page-doc
title: Variables
description: "Standard variables of Spress"
header: { title: Variables }
prettify: true
---
Any processable file with [Front-matter](/docs/front-matter) will have access
to these variables.

## Global

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>[site](#site-variables)</td>
            <td markdown="1">
                Site data with configuration variables from global and  
                `config.yml` from your site.
            </td>
        </tr>
        <tr>
            <td>[page](#page-variables)</td>
            <td>Page specific data with Front-matter variables.</td>
        </tr>
        <tr>
            <td>[paginator](#paginator-variables)</td>
            <td>
                If pagination is available, contains information about pagination
                data.
            </td>
        </tr>
        <tr>
            <td>[spress](#spress-variables)</td>
            <td>Data about application.</td>
        </tr>
    </tbody>
</table>

## Site variables {#site-variables}

Example of access in Twig: `{{ "{{ site.posts }}" }}`.

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>posts</td>
            <td>array</td>
            <td markdown="1">
                List of posts in reverse chronological order. Each element of this list is of type [page](#page-variables).
            </td>
        </tr>
        <tr>
            <td>pages</td>
            <td>array</td>
            <td markdown="1">
                List of pages. Each element of this list is of type [page](#page-variables).
            </td>
        </tr>
        <tr>
            <td>time</td>
            <td>string</td>
            <td>Timestamp when spress command was run.</td>
        </tr>
        <tr>
            <td>categories</td>
            <td>array</td>
            <td markdown="1">
                List of post groups by categories.
                E.g: `site.cagetories.news` get all posts with `news`
                category. Each element of this list is of type [page](#page-variables).
            </td>
        </tr>
        <tr>
            <td>tags</td>
            <td>array</td>
            <td markdown="1">
                List of post groups by tags.
                E.g: `site.tags.car` get all posts with `car`
                tag. Each element of this list is of type [page](#page-variables).
            </td>
        </tr>
        <tr>
            <td>your-variable-name</td>
            <td></td>
            <td markdown="1">
                Your custom variables in `config.yml` are available here.
                Example: `{{ "{{ site.your-variable-name }}" }}`.
            </td>
        </tr>
    </tbody>
</table>

## Page variables {#page-variables}

Example of access in Twig: `{{ "{{ page.title }}" }}`.

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>title</td>
            <td>string</td>
            <td>The title of the page.</td>
        </tr>
        <tr>
            <td>id</td>
            <td>string</td>
            <td>Identifier of the page.</td>
        </tr>
        <tr>
            <td>date</td>
            <td>string</td>
            <td markdown="1">
                The date assigned to the post in 
                [ISO 8601](http://en.wikipedia.org/wiki/ISO_8601)
                format.
            </td>
        </tr>
        <tr>
            <td>path</td>
            <td>string</td>
            <td>The path to the raw post or page.</td>
        </tr>
        <tr>
            <td>url</td>
            <td>string</td>
            <td markdown="1">
                The URL of the post. E.g: `/news/what-is-new/`. If you disable
                `relative_permalinks` option, the URL will be stored in absolute 
                format: `site.url` + `base_url` + `page.url`.
            </td>
        </tr>
        <tr>
            <td>categories</td>
            <td>array</td>
            <td>List of post categories.</td>
        </tr>
        <tr>
            <td>tags</td>
            <td>array</td>
            <td>List of post tags.</td>
        </tr>
        <tr>
            <td>content</td>
            <td>string</td>
            <td>Rendered content.</td>
        </tr>
    </tbody>
</table>

## Paginator variables {#paginator-variables}

Example of access in Twig: `{{ "{{ paginator.total_pages }}" }}`.

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>per_page</td>
            <td>int</td>
            <td>Number of posts per page.</td>
        </tr>
        <tr>
            <td>posts</td>
            <td>array</td>
            <td>Posts included in current page.</td>
        </tr>
        <tr>
            <td>total_posts</td>
            <td>int</td>
            <td>Total number of posts.</td>
        </tr>
        <tr>
            <td>total_pages</td>
            <td>int</td>
            <td>Total number of pages.</td>
        </tr>
        <tr>
            <td>page</td>
            <td>int</td>
            <td>Current page number.</td>
        </tr>
        <tr>
            <td>previous_page</td>
            <td>int</td>
            <td>Previous page number.</td>
        </tr>
        <tr>
            <td>previous_page_path</td>
            <td>string</td>
            <td>Path to the previous page.</td>
        </tr>
        <tr>
            <td>next_page</td>
            <td>int</td>
            <td>Next page number.</td>
        </tr>
        <tr>
            <td>next_page_path</td>
            <td>string</td>
            <td>Path to the next page.</td>
        </tr>
    </tbody>
</table>

## Spress variables {#spress-variables}

Example of access in Twig: `{{ "{{ spress.version }}" }}` or 
`{{ "{{ spress.paths.root }}" }}`.

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>version</td>
            <td>string</td>
            <td>Current version.</td>
        </tr>
        <tr>
            <td>paths</td>
            <td>array</td>
            <td>
                Paths used by Spress.
            </td>
        </tr>
    </tbody>
</table>

Inside path key:

* **root**: Absolute path to root of Spress application.
* **config**: Absolute path to global configuration directory.
* **config.file**: Global configuration filename.
* **templates**: Absolute path to templates directory.
