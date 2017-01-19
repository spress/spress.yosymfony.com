---
layout: blog/post
title: 'New in Spress 1.1: Environment configurations'
description: How to load configurations for different environments?
categories: [news]
tags: ['1.1', 'configuration','environment']
---
The development of Spress 1.1.0 continues with new features like support to load configurations for
different environments. This is **useful for writing configuration options for development
and production environments**. Each Spress site has a `config.yml` file (mandatory) with the options
for the default environment (dev). If you want set options for production environment you can
to create a `config_prod.yml` file with the options that will be overrided in `config.yml`.
The command line option `--env` let you to enable the environment.

--more Read more--

The pattern for environment configuration file is `config_{environment-name}.yml`.

### An example

The configuration options for default environment:

```
# config.yml

title: "Blogs and sites powered by flat files"
description: "Spress is a blog-aware application that transform your plain text files in static sites."
logo: "spress-logo.png"

url: ""
```

The `url` option for production environment will be overrided in `config.yml`:

```
# config_prod.yml

url: "http://spress.yosymfony.com"

```

Now you can build your site with development options: `$ spress site:build` or using options for production:
`$ spress site:build --env=prod`.

### How to get the environment's name in your templates or plugins?

In your templates the environment's name is located at `site.env`. If you are a plugin developer you can
get this value in `spress.start`, `spress.before_render`, `spress.after_render`, `spress.before_render_pagination`
or `spress.after_render_pagination` [events](/docs/developers/events-list).


You can get more information about [environment configurations in this proposal](https://github.com/yosymfony/Spress/issues/9).
