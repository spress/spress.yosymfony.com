---
layout: blog/post
title: 'New in Spress 2.2.0: themes and add-ons manager'
categories: ["news"]
tags: ["2.2.0"]
---
Hello everybody. The development of Spress 2.2.0 continues on its way and today
I want to show you two new features: the support for themes and a new set of
commands aimed to manage Spress's add-ons.

--more Read more--

## Themes

This version of Spress has a theme system. Typically a theme package layouts,
includes (reusable parts of a site) and assets and those can be overridden by
the site that are using the theme. Themes (and plugins too) are published via [Packagist.org](https://packagist.org/). You will need a
[Packagist account which you can create for free](https://packagist.org/register/).

### How to create a site based on a theme?

The `new:site` command has been modified to let you create sites based on themes.
With that purpose in mind, the command creates a blank site and sets the theme
as a requirement in the `composer.json` file. The below example creates a site
based on the latest development version of Spresso theme 2.1:

```
$ spress new:site my-site spress/spress-theme-spresso:2.1.*-dev
```
A site can has multiples themes installed but only one can be active at
a time. To add more themes you only need to run a `add:plugin` command with the
theme's name:

```
$ spress add:plugin my-vendor/theme2
```

The theme used by a site is defined at `name` key of the `config.yml`
file:

```yaml
themes:
  name: 'spress/spress-theme-spresso'
```

Ever you want to update the themes used by your site only need to perform a
`update:plugin` command:

```
$ spres update:plugin
```

**Note** that at this time, only Spresso theme has been adapted to the new
package manager of Spress.

See [new feature #98](https://github.com/spress/Spress/issues/98) for more details.

### How to create a theme?

In order to simplify things, there is a command for creating themes: `new:theme`.
This one let you create a blank theme or a theme using another pre-existing theme.

The below example will scaffolds a blank theme into `my-site` folder:
```
$ spress new:theme my-site
```

This time we will scaffold a theme based on Spresso into `my-site` folder:
```
$ spress new:theme mysite spress/spress-theme-spresso:2.1.*-dev
```

## Add-on manager

Spress 2.2.0 come with a simple package manager based on
[Composer](https://getcomposer.org/). Below, a list of new commands that
has been added:

* **new:theme**: Creates a new theme (blank or based on another pre-existent).
* **add:plugin**: Adds a new plugin or theme and resolves its dependencies.
* **remove:plugin**: Removes a plugin or theme previously intalled.
* **update:plugin**: Update plugins and themes on which your site depend on.

Additionally, `new:site` command has been modified and the `--all` option has been
declared as deprecated.

See [new feature #96](https://github.com/spress/Spress/issues/96) for more details.
