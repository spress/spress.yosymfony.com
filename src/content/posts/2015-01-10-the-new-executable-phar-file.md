---
layout: blog/post
title: "The new executable phar file"
categories: [news]
tags: [phar,php]
---
<img class="img-responsive" src="/assets/img/lego.jpg">

Photo by [Pascal](https://flic.kr/p/8cNqid).

With the release of Spress 1.1.0 we have a new way for getting Spress: as `phar` file.

> ...a phar archive provides a way to distribute a complete
> PHP application in a single file.

--more Read more--

Run a `phar` file is straightforward:

```
$ php spress.phar
```

or in Unix, Linux and Mac OS you can run directly:

```
$ spress.phar
```

More examples of use:

```
$ spress.phar new:site /my-folder spresso

$ spress.phar new:post
```

Go to [download](/download) section and choose `phar` option.

If you need more information about `phar` extension see the
[official PHP documentation](http://php.net/manual/en/intro.phar.php).

### Installing themes

With the `phar` file you can't install themes globally, I mean, modifying
`composer.json` of Spress installation folder. To install a theme you can
download a copy or fork a repository if the theme is hosted on Github.
