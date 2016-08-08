---
layout: blog/post
title: "Importing posts to Spress from Wordpress and CSV files is now possible thanks to Spress Import plugin"
categories: [plugin,news]
tags: [wordpress,csv,import]
---
<img class="img-responsive" src="/assets/img/wordpress-badges.jpg">

Photo by [Cristian Labarca](https://flic.kr/p/5zPaP6).

If you have a Wordpress blog hosted in Wordpress.com or installed in other web
host and you are thinkig of migratting to a static site you are in luck because
the brand-new [Spress Import plugin](https://github.com/spress/Spress-import)
can help you with that migration.

--more Read more--

Plugin download and intallation is very easy: you just go to your Spress site folder
and add the Spress import plugin as dependency by running:

```
composer require spress/spress-import
```

## Migrations from Wordpress

Wordpress migrations start generating a backup all of your content in a WXR file
(it's just a XML file).
Generating the WXR file differs slightly between Wordpress and Wordpress.com. For
the first, go to **Tool &rarr; Export** and then click the **Download Export File**
button to generate and save the file in your local computer. For the second case,
go to **My site &rarr; Setting** and then select the **Export** tab to download
a copy of your content. More details about how to export your blog at
[Wordpress](https://codex.wordpress.org/Tools_Export_Screen) and
[Wordpress.com](https://en.support.wordpress.com/export/#export-your-content-to-another-blog-or-platform).

Once the WXR file is saved in your local computer, you can run `spress import:wordpress`
command to generate the Spress content:

```
$ cd /your-spress-site
$ spress import:wordpress /path-to/my-wxr-file.xml --post-layout=post --fetch-images
```

The prior command imports all posts available in the WXR file and grabs the images
used by them. The option `--post-layout` sets `post` as the layout of all imported
posts. You have more options described in the [documentation](/docs/blog-migrations/#wordpress).

## Imporing from a CSV file

To import your posts from a CSV file, run:

```
$ spress import:csv /path-to/post.csv --post-layout=post
```

The columns' structure of the CSV file is the following:

1. **title**
2. **permalink**
3. **content**
4. **published_at**
5. **categories** (optional): a list of terms separated by semicolon. e.g:
"news;events".
6. **tags** (optional): a list of terms separated by semicolon.
7. **markup** (optional) markup language used in content. e.g: "md", "html".
"md" by default. This value will be used as filename's extension of the imported item.
You have more options described in the [documentation](/docs/blog-migrations/#csv-files).

At this time there are only two providers but I have planned to extend the provider
import family with other platforms and services such as Tumblr, Blogger
or Ghost to name a few. Remember: this plugin is open source and all
[contributions are welcome](https://github.com/spress/Spress-import).
