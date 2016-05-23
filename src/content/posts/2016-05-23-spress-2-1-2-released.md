---
layout: blog/post
title: "Spress 2.1.2 released"
categories: [releases]
tags: [2.x]

changelog_support: true
---
Hello. A new maintenance release of Spress has been released with two bug fixes.

The complete changelog:

* [New] Two new methods have been added to StringWrapper class: `lower` and `upper` for cingonvert a given string to lower-case and upper-case respectively using UTF-8 as encoding.
* [Fixed] Bug [#80](https://github.com/spress/Spress/issues/80) has been fixed: "`Composer install` fails if no namespace is specified in new plugin". See PR [#81](https://github.com/spress/Spress/issues/81).
* [Fixed] Bug [#82](https://github.com/spress/Spress/issues/82) has been fixed: "Substr `---` in yaml string cause builder crash".
* [Fixed] Bug [#83](https://github.com/spress/Spress/issues/83) has been fixed: "Same tags on different languages cause builder crash".


--more Read more--

## How to get this version?

If you are using Spress 2.x, the better way is to use `self-update` command:

```
$ spress self-update
``` 

To get this release directly:

```
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.1.2/spress.phar
```

Enjoy it!
