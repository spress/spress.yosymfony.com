---
layout: blog/post
title: "Spress 2.1.3 released"
categories: [releases]
tags: [2.x]

changelog_support: true
---
Hello community. A new maintenance release of Spress has been released. The highlights
this time have been a fix related with the content of `title_path` attribute
in case of filenames with dots before extension (previously, the value of this attribute appears truncated).
Additionally, the value of `title_path` will no longer be altered by `FilesystemDataSource`
class, only `rawurlencode` function is applied. If you have a file called
`02-02-spress-2.1.1-released.md` then the value of `title_path` will be
`spress-2.1.1-released` instead of `spress-2-1-1-released`.

Another improvement has been the [option for avoid scanning certains directories](/docs/configuration/#plugin_manager_builder)
such as `tests` when the plugin manager is loading classes in order to detect
which of those are plugins.

The complete changelog:

* [New] Class `FileInfo` has been added to the support classes set of the core.
* [New] New configuration value aimed to plugin manager builder for excluding directories in the disconvering class phase. Useful to avoid scaning test classes.
* [Fixed] Fixed the truncated `title_path` attribute when the filename contains dots before the extension. More details in bug #88.
* [Fixed] The value of `title_path` is not altered when it is parsed by `FilesystemDataSource` class. More details in bug #88.
* [Fixed] If you set `preserve_path_title` attribute to `true` you will get the title parsed from the filename as-is (without the date part). Only `rawurlencode` function is applied. See PR #90.

--more Read more--

## How to get this version?

You just need to run `self-update` command:

```
$ spress self-update
```
