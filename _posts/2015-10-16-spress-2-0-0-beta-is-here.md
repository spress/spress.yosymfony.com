---
layout: blog/post
title: "Spress 2.0.0-beta is here"
categories: [releases]
tags: [2.0.0]
---
Today is a great day because [Spress 2.0.0-beta](/about/changelog/) is here. In this release we have included
new features such as command plugins (a new kind o plugin), a new Markdown converter based on 
[Parsedown](http://parsedown.org/) a parser 2-3 times faster than
[Michel Fortin's parser](https://michelf.ca/projects/php-markdown/) implementation or the the expected
taxonomy generator.

## The highlight of this release

* **Command plugins**: a new kind of plugins witch provides subcommand for `spress` executable.
* **self-update command**: a new command for keeping Spress up to date.
* **Taxonomy generator** for grouping content around a set of terms.
* Added a new special attributte `avoid_renderizer` for avoiding the renderizer phase over an item of content. See [#59](https://github.com/spress/Spress/issues/59).
* Deleted the `site:new` alias for command `new:site`.

--more Read more--

### Command plugins

Command plugins lets you create plugins that provide subcommands for `spress` executable. For example they are
usefull for writing subcommands for handling [i18n](https://en.wikipedia.org/wiki/Internationalization_and_localization)
concerns. 

How to create a command plugin?

```
$ spress new:plugin
```

### self-update command

Keeping Spress up to date is straightforward as of this release. Then to update to the next
Spress 2.0.0-rc just type `spress self-update` or `spress selfupdate`

### Taxonomy generator

[Generators](https://github.com/spress/Spress/issues/45) are a new feature of Spress 2.0.0
for generating new items of content. Useful for pagination or as in this case for generating
the taxonomy items. See the feature [#57](https://github.com/spress/Spress/issues/57)
for more details about how to use.

## How to get this version?

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.0.0-beta/spress.phar
```

Next release will be the *release candidate*. If you notice any problems, please open a
[issue](https://github.com/spress/Spress/issues) on Github.

Enjoy it!