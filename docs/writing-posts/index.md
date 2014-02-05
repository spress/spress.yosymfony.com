---
layout: page-doc
title: Writing posts
header: { title: Writing posts   }
prettify: true
---
Write a post is straightforward and without database. You only need create a 
text file in `_posts` folder of your site and write it using 
[Markdown](http://daringfireball.net/projects/markdown/syntax) syntax.

```
---
layout: default
---
This is a post. You can mixing text and HTML like this:
<a href="{{ "{{ site.url }}" }}"/about/>About me</a>.

Uses variables in Markdown link:
[Home](<{{ "{{ site.url }}" }}>)
```

If your post is a draft, set `draft` variable to true in the Front-matter:

```
---
draft: true
---
```

The draft posts don't be included by defatult in the result site. If you want
draft posts included, use the flag `--drafts` with `site:build` command.

## Creating a post file

Your posts files are located in `_posts` folder. A file post have a special
name format: `year-month-day-title.md` (.md is the file extension). 

* **year**: Four-digit number.
* **month**: Two-digit number.
* **day**: Two-digit number.
* **title**: The title without spaces and only can have URL valid characters.

Example of valid posts files:

* 2013-12-01-my-first-post.md
* 2013-11-01-what-is-new.md

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
        <div class="col-md-1">
            <i class="fa fa-bookmark-o fa-3x"></i>
        </div>
        <div class="col-md-11">
            <p markdown="1">
                The default Markdown file extensions are 
                **markdown, mkd, mkdn** or **md**.
            </p>
        </div>
    </div>
  </div>
</div>

### Categories from the directory structure
The categories of a post can be set from the Front-matter or deducted from the
directory structure.

```
_posts
| |- 2013-12-01-my-first-post.md
| |- news
| | |- 2013-11-01-what-is-new.md
```
`2013-11-01-what-is-new.md` have a **news** category.