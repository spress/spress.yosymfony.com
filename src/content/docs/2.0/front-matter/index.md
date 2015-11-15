---
layout: page-doc-2.0
title: Front-matter
header: { title: Front-matter }
prettify: true
---
Front-matter block lets you specify certain attributes of the page 
and define new variables that will be available in the content. 

**The Front-matter must be the first thing in the file**.

```
---
layout: default
title: "Hello world" # Replace the posts title from the file.
my_name: "Victor"
---
This is a post body.
```

The Front-matter uses [YAML](http://yaml.org) syntax. Your new variables will
be accessible for Twig: `My name is {{ "{{ page.my_name }}" }}`. 

Only the proccessable files with Front-matter block will be treated as special file.
A empty Front-matter is valid:

```
---
---
This is a post.
```

## Special variables {#special-variables}
### Page or post {#pagepost-variables}
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
            <td>layout</td>
            <td>string</td>
            <td markdown="1">
                Set the name of the layout file without extension. Layout files
                are located in `./src/layouts` directory.
            </td>
        </tr>
    </tbody>
</table>

### Posts {#post-variables}
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
            <td>Override title from the name of the post file.</td>
        </tr>
        <tr>
            <td>categories</td>
            <td>array</td>
            <td>List of categories of the post.</td>
        </tr>
        <tr>
            <td>tags</td>
            <td>array</td>
            <td>List of tags of the post.</td>
        </tr>
        <tr>
            <td>draft</td>
            <td>boolean</td>
            <td markdown="1">The post is a draft. `false` is the default value.</td>
        </tr>
        <tr>
            <td>date</td>
            <td>string</td>
            <td>
                Override the date from the name of the post file. Useful if you want
                to alter the sorting of posts.
            </td>
        </tr>
    </tbody>
</table>
