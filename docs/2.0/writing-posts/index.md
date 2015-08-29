---
layout: page-doc
title: Writing posts
description: How to write a post for Spress
header: { title: Writing posts }
prettify: true
---
Posts are plain text files written using [Markdown](http://daringfireball.net/projects/markdown/syntax)
syntax stored at `./src/content/posts` folder. It’s easy to manually create posts
but Spress provides a `new:post` command:

```
$ spress new:post
```

By default, the command interacts with the user to tweak the generation.
The complete syntax of the command is:

```
new:post [--title="..."] [--layout="default"] [--date="..."] [--tags="..."] [--categories="..."]
```

Any passed option will be used as a default value for the interaction.

* `--tags`: Tags list separed by white spaces.
* `--categories`: Categories list separed by white spaces.

An example of a post using `default` layout:

```
---
layout: default
---
This is a post. You can mix text and HTML like this:
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

The draft posts won't be included by defatult in the generated site. If you want 
to include draft posts, use the flag `--drafts` with `site:build` command.

```
spress site:build --drafts
```

## Creating a post file manually

Your post files are located in `./src/content/posts` folder. A post file have a special
name format: `year-month-day-title.md` (`.md` is the file extension). 

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

The categories of a post can be set in the Front-matter or deducted from the
directory structure. In the following example, `2013-11-01-what-is-new.md` will have 
**news** category assigned because the post is stored at `news` folder:

```
_posts
| |- 2013-12-01-my-first-post.md
| |- news
| | |- 2013-11-01-what-is-new.md
```

### Assigning categories in the Front-matter

Instead of placing posts inside folders you can specify your categories using
`categories` variable in the Front-matter:

```
---
categories: [news, releases]
---
```

### Tags

Multiple tags can be added to a post using `tags` variable in the Front-matter:

```
---
tags: [tech, twitter]
---
```
