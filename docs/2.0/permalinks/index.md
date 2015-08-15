---
layout: page-doc
title: Permalinks
header: { title: Permalinks }
prettify: true
---
The permalinks of the posts can be customized with a template. In the `config.yml` 
of your site you can set the value of `permalink` with your template:

```
# Example:

permalink: "/:year/:title"
```

The default value of `permalink` is `pretty`.

### Template variables:

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>:year</td>
            <td>
                Year from the Post.
            </td>
        </tr>
        <tr>
            <td>:month</td>
            <td>
                Month from the Post.
            </td>
        </tr>
        <tr>
            <td>:i_month</td>
            <td>
                Month from the post without leading zeros.
            </td>
        </tr>
        <tr>
            <td>:day</td>
            <td>
                Day from the Post.
            </td>
        </tr>
        <tr>
            <td>:i_day</td>
            <td>
                Day from the post without leading zeros.
            </td>
        </tr>
        <tr>
            <td>:title</td>
            <td>
                Title from the post.
            </td>
        </tr>
        <tr>
            <td>:categories</td>
            <td>
                The categories from the post.
            </td>
        </tr>
    </tbody>
</table>

### Predefined templates

Spress have a predefined templates. If you want to configure it in your site 
simply use its name:

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
            <td>pretty</td>
            <td>/:categories/:year/:month/:day/:title/</td>
            <td>
                http://yourdomain.com/news/2013/12/31/new-apps/
            </td>
        </tr>
        <tr>
            <td>ordinal</td>
            <td>/:categories/:year/:i_day/:title.html</td>
            <td>
                http://yourdomain.com/news/31/new-apps.html
            </td>
        </tr>
        <tr>
            <td>date</td>
            <td>/:year/:month/:day/:title.html</td>
            <td>
                http://yourdomain.com/2013/12/31/new-apps.html
            </td>
        </tr>
    </tbody>
</table>