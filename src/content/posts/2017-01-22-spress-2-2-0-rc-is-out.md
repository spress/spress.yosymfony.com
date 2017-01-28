---
layout: blog/post
title: "Spress 2.2.0-rc is out. Help us to test"
categories:
  - "releases"
tags:
  - "2.x"
---
Hello community. Last Monday 16th of January I released the first [RC of
Spress 2.2.0](https://github.com/spress/Spress/releases/tag/v2.2.0-rc)
(I think this will be the only RC). We need help for testing the new features.
This version comes with a few new features such as a [package manager](https://github.com/spress/Spress/issues/96), support for themes or the
migration of Symfony components from 2.7 to 3.2. This migration could throw some
excetions due to the deprecations introduced in Symfony Yaml component since version 2.8.
In the coming days I'm going to update the documentation
according to the new features. Additionaly, I'm going to review the themes
of [Spress add-ons organization on Github](https://github.com/spress-add-ons).

--more Read more--

## How to get the latest version of Spresso theme?

With the new package manager creating a new site based on a pre-existing theme
is very easy. You just perform the following command:

```
$ spress new:site mysite spress/spress-theme-spresso:2.1.*-dev
```

Notice that `-dev` sufix indicates the stability of the theme. At this moment only
`dev` stability for 2.1 is available. If Spresso theme releases a new version,
to update your site to the latest version is a very easy task thanks to the
newly added `update:plugin` command:

```
$ cd your-site/
$ spress update:plugin
```
More details about [package versioning on Composer web](https://getcomposer.org/doc/articles/versions.md).

## Fixing the error "A colon cannot be used in an unquoted mapping value"

This error appears as a consecuence of migrations of Symfony Yaml component to 3.2.
In this version certain characters such as `:` cannot be used in a unquoted value.
To fix this problem you just surround the string literal with quotes.

## How to get this version?

To get this release directly:

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.2.0-rc/spress.phar
```
