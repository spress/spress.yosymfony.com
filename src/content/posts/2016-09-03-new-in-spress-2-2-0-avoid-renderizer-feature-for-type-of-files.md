---
layout: blog/post
title: 'New in Spress 2.2.0: "avoid_renderizer" feature for type of files'
categories: ["news"]
tags: ["2.2.0"]
---
Hello community! Spress is on the way to 2.2.0 and today we want to unveil
a [new feature](https://github.com/spress/Spress/issues/91) for applying the ["avoid_renderizer"](docs/themes/#avoid-renderizer)
feature automatically to both certain type of files and files that belong to a path.
The `avoid_renderizer` attribute let's avoid the [renderizer](/docs/developers/renderizer/)
comes into action with a file. Prior to Spress 2.2.0, you needed to put this attribute
file by file. Now, you can set a filter in the `config.yml` file like the following:

```yaml
# config.yml
avoid_renderizer:
  filename_extensions: ['css', 'js']
  paths: ['assets']
```

In the prior example, all files belonging to `assets` folder (this folder is relative
to `src/content` path) or those with a filename's extension type `css` or `js`
will receive an `avoid_renderizer: true` attribute unless otherwise expressly
provided in a file.

Spress comes with the following configuration by default:

```yaml
avoid_renderizer:
  filename_extensions: ['css', 'js']
  paths: ['assets', 'bower_components', 'node_modules']
```
