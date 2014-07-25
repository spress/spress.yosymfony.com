---
layout: page-doc
title: Docs
header: { title: Docs, sub: Welcome }
prettify: true
---
This guie will cover topics like create a site, write a post or create a theme.

###Requirement
* PHP 5.4 or great.
* [Composer](http://getcomposer.org/) (if you get vendors manually)
* Linux, Unix or Mac OS X.

###Installation
Install Spress from Github repository, Packagist or ZIP file.

####From ZIP file (*nix and Mac OS X)
[Download](/download) the zip file and uncompress in `/your-spress-installation-dir`.
Spress excutable are located in `bin/spress`. If you want use the executable 
globally, you can create a symbolic link:

```

$ cd /your-spress-installation-dir
$ ln -s /your-spress-installation-dir/bin/spress /usr/local/bin/spress
```

**If the above fail due to permissions, run the second command with *sudo*.**

####From Github

Install composer in your project:

```
curl -s https://getcomposer.org/installer | php
```

Clone repository:

```
$ git clone https://github.com/spress/Spress.git
$ cd /your-spress-repository-dir

# Get vendors:
$ php composer.phar install

# Ready!!
```

The `spress` executable is located at `/your-spress-repository-dir/bin`.

####Composer global installation

You need to install Composer as before explained. 

```
php composer.phar global require spress/Spress:1.*
```

Next you have ready the `spress` command in your console. More information about
[Composer global installation](https://getcomposer.org/doc/03-cli.md#global).

###Starting
You need create a site and build it. With Spress executable, you can create a 
site blank or using a base theme and next build your site. 

**Quick-start**:

```
$ spress site:new /your-site-dir spresso
$ cd /your-site-dir
$ spress site:build

$ cd /yout-site-dir/_site
$ php -S localhost:8080

# Browse to localhost:8080
```

With `site:new` command you create a new site using Spresso theme. Next,
you can build your site with `site:build` command. You'll get the result in 
`_site` dir.
