---
layout: page-about
header: { title: Change log, sub: Release history }
title: Changelog
id_content: changelog 
---

More information about the [releases](https://github.com/yosymfony/Spress/releases).

## v1.0.3 {#1-0-3}
Date: 2014-05-22

* <span class="label label-default">Fixed</span> bug [#7](https://github.com/yosymfony/Spress/issues/7): Error with Site Build.
* <span class="label label-primary">Improved</span> Tested on PHP 5.6 (Travis CI).

## v1.0.2 {#1-0-2}
Date: 2014-03-30

* <span class="label label-default">Fixed</span> bug [#6](https://github.com/yosymfony/Spress/issues/6): Twig tags not rendered in posts located at variable `site.posts`.
* <span class="label label-default">Fixed</span> bug [#6](https://github.com/yosymfony/Spress/issues/6) with variables `site.categories` and `site.tags`.
* <span class="label label-primary">Improved</span> Variables site.categories and site.tags have page-identifier as index of array.
* <span class="label label-primary">Improved</span> Base implementation of ContentItemInterface created at ContentItem. The classes PageItem and PostItem extend from this.



## v1.0.1 {#1-0-1}
Date: 2014-03-08

* <span class="label label-success">New</span> events related with pagination phase (issue [#3](https://github.com/yosymfony/Spress/issues/3)): **spress.before_render_pagination** and **spress.after_render_pagination**.
* <span class="label label-primary">Improved</span> Payload argument of Render method (plugins TemplateManager) is optional.
* <span class="label label-primary">Improved</span> pagination phase of posts.
* <span class="label label-default">Fixed</span> bug [#4](https://github.com/yosymfony/Spress/issues/4): UrlGenerator always has ending slash.
* <span class="label label-default">Fixed</span> the class loader path when Spress is installed as package.

## v1.0.0
Date: 2014-02-05

* <span class="label label-success">New</span> Added template manager to the API plugins for rendering Twig templates (accessible from spress.start event).
* <span class="label label-primary">Improved</span> the class loader of the site plugins.
* <span class="label label-default">Fixed</span> documentation

## v1.0.0-rc.3
Date: 2014-01-12

* <span class="label label-success">New</span> Support to composer for spress site plugins.
* <span class="label label-success">New</span> Install themes with Composer.
* <span class="label label-success">New</span> Generate composer.json in a blank site.
* <span class="label label-primary">Improved</span> the search of folders that starting with underscore.
* <span class="label label-default">Fixed</span> the documentation.
* <span class="label label-danger">Deleted</span> Spresso theme. Now is a package.
