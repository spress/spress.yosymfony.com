---
layout: blog/post
title: "Spress cartridge for Openshift"
categories: [news]
tags: [openshift,cartridge,deploy,cloud]
draft: true
---
<img class="center-block" src="http://upload.wikimedia.org/wikipedia/en/3/3a/OpenShift-LogoType.svg">

Logo owned by Red Hat for [OpenShift](http://openshift.com).

OpenShift is a cloud computing platform as a service from Red Hat for run applications in several
platform like NodeJs, Java and PHP. Openshift is a one of the most common PaaS because has a 
competitive prices for computing with free and premium plans. The free plan is a good starting 
point for creating static blogs and web pages. Openshift is organized in Gears and inside of each
Gears we have one or more cartridges. OpenShift has a few prepared carteridges for PHP, Javas, MySQL
and other applications. Today we are proudly to present a 
[Cartridge for run a static site or blog](https://github.com/spress/Openshift-spress-cartridge)
using Spress.

--more Read more--

## How to create a static site on Openshift

To uses this cartridge you need an account on Openshift.

1. Go to Openshift and log-in or sign-on for new accounts.
2. Create a new application.
3. Choose a type application: go to "Code Anythig" and paste the URL of the manifest file:
`http://spress.yosymfony.com/openshift-cartridge/manifest.yml`.

<img class="center-block" src="{{ site.url }}/assets/img/create-custom-cartridge.png">

4. Set the application name and press "Create Application"