---
layout: page-doc-2.0
title: Getting started with Spress
description: "Getting started with Spress: setup and create the first site"
header:
  title: Getting started
menu:
  id: doc 2.0
  title: Getting started
  order: 1
prettify: true
---
In this guide you will learn how Spress works and how easy is to publish a site.

### Requirements {#requirements}

* GNU/Linux, Unix, or macOS.
* PHP 5.6 or greater.

### Installation {#installation}

The best way to get Spress is to download the PHAR file:

```
$ curl -LOS {{ site.release.url_phar }}
$ chmod +x spress.phar
```

if you want use the executable globally, move it to `/usr/local/bin/`:

```
$ sudo mv spress.phar /usr/local/bin/spress
```

#### On Windows
Globally installing of Spress involves a few steps:

1. Create a directory for PHP binaries; e.g., `C:\bin`.
2. Append `;C:\bin` to your `PATH` environment variable.
3. Download [{{ site.release.url_phar }}](<{{ site.release.url_phar }}>) and save the file as `C:\bin\spress.phar`.
4. Open a command line (e.g., press **Windows+R** &rarr; type `cmd` &rarr; **ENTER**).
5. Create a wrapping batch script (results in `C:\bin\spress.cmd`):

```
C:\Users\username> cd C:\bin
C:\bin> echo @php "%%~dp0spress.phar" %%* > spress.cmd
C:\bin> exit
```
6. Open a new command line and confirm that you can execute spress from any path:

```
C:\Users\username> spress --version
Spress - The static site generator version x.y.z
```

For [Cygwin](https://en.wikipedia.org/wiki/Cygwin) and/or [MingW32](http://mingw.org/) (e.g., TortoiseGit)
shell environments, you may skip step 5. above, simply save the file
as `spress` (without `.phar` extension), and make it executable via `chmod 775 spress`.

### Quick start

Lets create a sample site and build it. With Spress executable, you have two options:

1. To scaffold a blank site.
2. To use a base theme.

Lets create our site using [Spresso](https://github.com/spress/Spress-theme-spresso) theme:

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
        <div class="col-md-1">
            <i class="fa fa-bookmark-o fa-3x"></i>
        </div>
        <div class="col-md-11">
            <p markdown="1">
                Spresso is the theme base of Spress. See the [Add-ons](/add-ons)
                page for more themes and plugins.
            </p>
        </div>
    </div>
  </div>
</div>

```
$ spress new:site /your-site-dir spress/spress-theme-spresso
$ cd /your-site-dir
$ spress site:build --server --watch

# Browse to localhost:4000
```

With `new:site` command Spress creates a new site using Spresso theme. Next,
you can build your site with `site:build` command. You'll get the result at
`build` folder.

The `--server` option launches a *built-in* server which lets you see your site
at `http://localhost:4000`. `--watch` option tells Spress to watch your files for
changes.
