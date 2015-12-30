---
layout: page-doc-2.0
title: Variables
description: Standard variables of Spress
header:
  title: Variables
menu:
  id: doc 2.0
  title: Variables
  order: 4
prettify: true
---
Spress exposes several variables containing site data.

## Global {#global-variables}

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td markdown="1">[site](#site-variables)</td>
            <td markdown="1">
                Contains site information and site configuration read from `config.yml`.
            </td>
        </tr>
        <tr>
            <td markdown="1">[page](#page-variables)</td>
            <td>Page specific data with variables declared at Front matter and metadata files.</td>
        </tr>
        <tr>
            <td markdown="1">[spress](#spress-variables)</td>
            <td>Contains information about Spress itself.</td>
        </tr>
    </tbody>
</table>

## Site variables {#site-variables}

Example of access with Twig: `{{ "{{ site.categories }}" }}`.

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
            <td>collections</td>
            <td>array</td>
            <td markdown="1">
                List of all collections. Each element of this list is of type [collection](#collection-variables).
                The key of each element is the collection's name.
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

## Collection variables {#collection-variables}

Example of access with Twig: `{{ "{{ site.collections.collection-name.path }}" }}`.

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
            <td>path</td>
            <td>string</td>
            <td markdown="1">
                The collection's relative path to `src` folder.
            </td>
        </tr>
        <tr>
            <td>output</td>
            <td>boolean</td>
            <td markdown="1">
                With a `true` value the collection's item will be output as individual file.
            </td>
        </tr>
         <tr>
            <td>your-variable-name</td>
            <td></td>
            <td markdown="1">
                Your custom variables declared at the collection definition are available here.
                Example: `{{ "{{ site.collection-name.your-variable-name }}" }}`.
            </td>
        </tr>
    </tbody>
</table>

## Page variables {#page-variables}

Example of access with Twig: `{{ "{{ page.id }}" }}`.

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
            <td>id</td>
            <td>string</td>
            <td>Identifier of the item.</td>
        </tr>
        <tr>
            <td>collection</td>
            <td>string</td>
            <td>The name of the collection assigned to item.</td>
        </tr>
        <tr>
            <td>mtime</td>
            <td>string</td>
            <td markdown="1">
                The modified time in [ISO 8601](http://en.wikipedia.org/wiki/ISO_8601)
                format.
            </td>
        </tr>
        <tr>
            <td>filename</td>
            <td>string</td>
            <td>The name of the file.</td>
        </tr>
        <tr>
            <td>extension</td>
            <td>string</td>
            <td>The extension of the file.</td>
        </tr>
        <tr>
            <td>path</td>
            <td>string</td>
            <td markdown="1">
                The path relative to `src` folder. e.g: `about/changelog.md`.
            </td>
        </tr>
        <tr>
            <td>url</td>
            <td>string</td>
            <td markdown="1">
                The URL of the post. e.g: `/about/changelog/`.
            </td>
        </tr>
        <tr>
            <td>content</td>
            <td>string</td>
            <td>Compiled content.</td>
        </tr>
    </tbody>
</table>

### Additional variables for files with `yyyy-mm-dd-title` pattern

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
            <td>title_path</td>
            <td>string</td>
            <td markdown="1">
                The title obtained from filename. e.g: "hola user" from `2015-12-08-hola-user.md`.
            </td>
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
    </tbody>
</table>


### Additional variables for Posts

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
            <td>categories</td>
            <td>array</td>
            <td>List of post categories.</td>
        </tr>
        <tr>
            <td>tags</td>
            <td>array</td>
            <td>List of post tags.</td>
        </tr>
    </tbody>
</table>


## Spress variables {#spress-variables}

Example of access with Twig: `{{ "{{ spress.version }}" }}`.

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
            <td>Current version. e.g: 2.0.1-rc</td>
        </tr>
        <tr>
            <td>version_id</td>
            <td>string</td>
            <td>
                Version ID. e.g: 20001
            </td>
        </tr>
        <tr>
            <td>major_version</td>
            <td>string</td>
            <td>
                Major version. e.g: 2.
            </td>
        </tr>
        <tr>
            <td>minor_version</td>
            <td>string</td>
            <td>
                Minor version. e.g: 0.
            </td>
        </tr>
        <tr>
            <td>release_version</td>
            <td>string</td>
            <td>
                Release version. e.g: 1.
            </td>
        </tr>
        <tr>
            <td>extra_version</td>
            <td>string</td>
            <td>
                Extra information about the relese. e.g: rc.
            </td>
        </tr>
        <tr>
            <td>external</td>
            <td>array</td>
            <td>
                External variables passed to Spress prior to compiling the site.
            </td>
        </tr>
    </tbody>
</table>
