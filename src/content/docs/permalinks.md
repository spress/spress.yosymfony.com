---
layout: page-doc-2.0
title: Permalinks
header:
  title: Permalinks
menu:
  id: doc 2.0
  title: Permalinks
  order: 9
prettify: true
---
Permalinks of items can be customized with a template through the `config.yml` file
of your site or as an attribute for each page. Permlinks lets you specify where compiled
items should be written.

```
permalink: "/:path/:basename.:extension"
```

## Template variables {#template-variables}

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>:path</td>
            <td markdown="1">
                Relative path to content folder without filename. e.g: `posts`.
            </td>
        </tr>
        <tr>
            <td>:extension</td>
            <td markdown="1">
                Filename extension. e.g: `md`.
            </td>
        </tr>
        <tr>
            <td>:basename</td>
            <td markdown="1">
                Base name of the file without path info. e.g: `/about/changelog.md` gets `changelog`.
            </td>
        </tr>
        <tr>
            <td>:collection</td>
            <td markdown="1">
                Collection name assigned to an item. e.g: `posts`.
            </td>
        </tr>
        <tr>
            <td>:categories</td>
            <td>
                The categories from the post.
            </td>
        </tr>
        <tr>
            <td>:title</td>
            <td markdown="1">
                Title from the post. Slugified tittle. e.g: `welcome-to-my-blog`.
            </td>
        </tr>
        <tr>
            <td>:year</td>
            <td markdown="1">
                Year extracted from `date` attribute or current date. e.g: `2015`.
            </td>
        </tr>
        <tr>
            <td>:month</td>
            <td markdown="1">
                Month extracted from `date` attribute or current date. e.g: `01`.
            </td>
        </tr>
        <tr>
            <td>:i_month</td>
            <td markdown="1">
                Month extracted from `date` attribute or current date without leading zeros. e.g: `1`.
            </td>
        </tr>
        <tr>
            <td>:day</td>
            <td markdown="1">
                Day extracted from `date` attribute or current date. e.g: `01`.
            </td>
        </tr>
        <tr>
            <td>:i_day</td>
            <td markdown="1">
                Day extracted from `date` attribute or current date without leading zeros. e.g: `1`.
            </td>
        </tr>
    </tbody>
</table>

## Predefined permalink templates {#predefined-templates}

Spress have a few predefined permalink templates. If you want to configure it 
on your site simply use its name:

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Template</th>
            <th>Example</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>none</td>
            <td markdown="1">`/:path/:basename.:extension`</td>
            <td>
                /about/changelog.html
            </td>
        </tr>
        <tr>
            <td>pretty</td>
            <td markdown="1">
                `/:categories/:year/:month/:day/:title` or `/:path/:basename`.
            </td>
            <td>
                /news/2015/12/31/new-apps/
            </td>
        </tr>
        <tr>
            <td>ordinal</td>
            <td markdown="1">
                `/:categories/:year/:i_day/:title.:extension`
            </td>
            <td>
                /news/2015/31/new-apps.html
            </td>
        </tr>
        <tr>
            <td>date</td>
            <td markdown="1">
                `/:categories/:year/:month/:day/:title.:extension`
            </td>
            <td>
                /2015/12/31/new-apps.html
            </td>
        </tr>
    </tbody>
</table>

The default value of `permalink` attribute is `pretty`.
All predefined permalink templates with a date component depends of `date` attribute. In case of
missing, `none` template will be applied.

### The pretty style

This is a extensionless permalink that contain neither a trailing slash nor a file extension.
If the out extension of an item is other than `html` then `none` template will be applied.
Sometimes this configuration requires additional support from the web server.
See [try_files on Nginx](http://nginx.org/en/docs/http/ngx_http_core_module.html#try_files) or [multiviews](https://httpd.apache.org/docs/current/content-negotiation.html#multiviews) on Apache.
