---
layout: blog/post
title: "Spress cartridge for Openshift"
description: "An OpenShift cartridge to run a static blog or website using Spress"
categories: [news]
tags: [openshift,cartridge,deploy,cloud]
---
<img class="center-block" src="/assets/img/openshift-logo.svg">

Logo owned by Red Hat for [OpenShift](http://openshift.com).

OpenShift is a cloud computing platform as a service from Red Hat for running applications in several
platform like NodeJs, Java or PHP. Openshift is a one of the most common PaaS because has a
competitive prices for computing with free and premium plans. The free plan is a good starting
point for creating static blogs and web pages. Openshift is organized in Gears and inside of each
Gears we have one or more cartridges. OpenShift has a few prepared carteridges for PHP, Java, MySQL
and other applications. Today we are proudly to present a
[Cartridge for running a static site or blog](https://github.com/spress/Openshift-spress-cartridge)
using Spress.

--more Read more--

## How to create a static site on Openshift

To use this cartridge you need an account on Openshift.

1. Go to [Openshift](http://openshift.com/) and log-in or sign-on for new accounts.
2. Create a new application.
3. Choose a type application: go to "Code Anythig" and paste the URL of the manifest file:
`http://spress.yosymfony.com/openshift-cartridge/manifest.yml`.

<img class="center-block" src="{{ site.url }}/assets/img/create-custom-cartridge.png">

4. Set the application name and press "Create Application"

### Using console tool

Another way to create an application based on this cartridge is using the console tool:

1. Installing the [OpenShift Client Tools](https://developers.openshift.com/en/managing-client-tools.html) (RHC).
2. Create a new application on OpenShift using this command:
``` bash
rhc app create spress http://spress.yosymfony.com/openshift-cartridge/manifest.yml
```
* Ready! you can access to your new site.

## Modify your site

The last step of this process is to modify your new site:

* Clone the repository that is associated with your OpenShift gear to your local machine.
* `cd /YOUR-REPOSITORY-FOLDER`
* The `www/` folder contains your Spress site.
* Make your changes and send a pull to repository. You do not need to upload your `_site`
folder that is created by running Spress locally.
* Your OpenShift gear will take care of building your site with your changes.

**Note** that each time you make a pull to repository, your site is builing with `--env=prod` option.
Do not change the values for `host` and `port` variables at `config_prod.yml`.

Enjoy it!
