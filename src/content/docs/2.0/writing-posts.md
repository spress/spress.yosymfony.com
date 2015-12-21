---
layout: page-doc-2.0
title: Writing posts
description: How to write a post for Spress
header:
  title: Writing posts
menu:
  id: doc 2.0
  title: Writing posts
  order: 8
prettify: true
---
Posts are a kind of [page](/docs/2.0/creating-pages) located at `./src/content/posts` typically
written using [Markdown](http://daringfireball.net/projects/markdown/syntax) syntax and
with a special filename pattern.

The following examples assume that you are using a site with Spresso theme. If not, you
can create one with `new:site` command:

```
$ spress new:site example spresso
```

It’s easy to manually create posts but Spress provides a `new:post` command:

```
$ spress new:post
```

By default, the command interacts with the user to tweak the generation. The complete syntax
of the command is availabe [here](/docs/2.0/how-it-works/#new-post).

## An example of a post

```
---
layout: "post"
title: "Welcome"
description: "Welcome to my first post"
categories: ["news"]
tags: ["twitter", "blog"]
---
This is a post. You can mix text and HTML like this:
<a href="{{ "{{ site.url }}" }}"/about/>About me</a>.

Uses variables in Markdown link:
[Home](<{{ "{{ site.url }}" }}>)
```
Multiple tags can be added to a post using `tags` [attribute](/docs/2.0/attributes).

### Categories

The categories of a post can be set as using the `categories` attribute or deducted from the
directory structure. In the following example, `2015-12-01-what-is-new.md` will have 
**news** category assigned because the post is stored at `news` folder:

```
./src
|- /content
|  |- /posts
|  |  |- 2015-12-01-my-first-post.md
|  |  |- /news
|  |  |- |- 2015-11-01-what-is-new.md
```

### Preserve title from filename in permalinks

In case of you want to preserve the title extracted from the filename over the `title` 
attribute assigned at Front matter block  in permalinks you can use `preserve_path_title` attribute.

e.g: a post filename like: `2015-03-12-spress-is-a-static-site-generator.md`

```
---
layout: post
title: Spress 静态网站生成器
preserve_path_title: true
categories: [Blog]
---
```

If you want set `preserve_path_title: true` as default for all your posts you need to add this attribute
to your post collection. Open the `config.yml` file of your site and add the following lines:

```
collections:
  posts:
    output: true
    preserve_path_title: true
```

## Drafts

They are posts you’re still working on and don’t want to publish yet
To enable a draft set `draft` attribute to `true:

```
---
layout: "post"
title: "Welcome"
description: "Welcome to my first post"
categories: ["news"]
tags: ["twitter", "blog"]
draft: true
---
This is a post.
```

Draft posts won't be included by defatult in the compiled site. If you want 
to include draft posts, use the flag `--drafts` with `site:build` command.

```
$ spress site:build --drafts
```

## Creating a post file manually

A post filename have a special name pattern: `year-month-day-title.md` (`.md` is the file extension). 

* **year**: Four-digit number.
* **month**: Two-digit number.
* **day**: Two-digit number.
* **title**: The title without spaces and only can have URL valid characters.

Example of valid posts files:

* 2013-12-01-my-first-post.md
* 2013-11-01-what-is-new.md

This pattern of filename will adds automatically the following attributes to the item: `date` and `title`.
