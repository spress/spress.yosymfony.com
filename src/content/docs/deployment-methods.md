---
layout: page-doc-2.0
title: Deployment methods
description: Deploying Spress sites
header:
  title: Deployment methods
menu:
  id: doc 2.0
  title: Deployment methods
  order: 13
prettify: true
---
There are several ways to deploy a site to your web host:

* [FTP](#ftp)
* [rsync](#rsync)
* [Github Pages](#github-pages)
* [Openshift](#openshift)

### FTP {#ftp}

Traditional web hosting providers lets you upload files to their servers using FTP protocol.
Once you've generated your site at `./build` folder running `spress site:build` command you
can upload the content of that folder to your hosting provider using a FTP application like
[Cyberduck](https://cyberduck.io/) available for Mac OS and Windows. For *nix case, you can
use [Duck CLI](https://duck.sh/).

### rsync {#rsync}

**rsync** is a widely-used utility to keep copies of a file on two computer systems the same.
Once you have generated your site at `./build` folder, run the following command to synchronize
your generated site with the `httpdocs` folder at your web host:

```
rsync -avze 'ssh -p 999' build/ youruser@yoursite.com:httpdocs
```

### Github pages {#github-pages}

[Github](https://github.com/) is a repository hosting service that offers a simple hosting for personal
and project sites. See the instruction of [Github pages](https://pages.github.com/)
for more information about how to publish a site.

### Openshift {#openshift}

[OpenShift](https://www.openshift.com/) is a cloud computing platform as a service from Red Hat.
We have prepared a [Cartridge for running a static site or blog](https://github.com/spress/Openshift-spress-cartridge)
in your OpenShift Gear. More information about how to use the [Spress Cartridge](/news/2015/01/17/spress-cartridge-for-openshift/). **Notice** that version used by the Cartridge is 1.1.0. We are working in a new version with Spress 2.x.
