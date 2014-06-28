---
layout: blog/post
title: New in Spress 1.1: Plugins manager improved
description: Plugins for Spress (static site generator)
categories: [news]
tags: ['1.1', 'plugins']
---
The plugins manager has been [improved](https://github.com/yosymfony/Spress/issues/11) for the next 
Spress 1.1.0. Prior to version 1.1.0 for each Plugin was necessary a `composer.json` file. Now this file is optional
and you can use it for distributable plugins with [Packagist](https://packagist.org/) or for plugins
with namespace.

--more Read more--

## The structure of a plugin

The basic structure of a plugin:

```
_plugins/
|- YourPlugin.php
```

Create a plugin at the root without `composer.json` file and without touch the *classloader* is
easy. Plugins can be placed in a sub folder and it's recommended. The aspect of your plugin file is this:

```
use Yosymfony\Spress\Plugin\Plugin;
use Yosymfony\Spress\Plugin\Event;
use Yosymfony\Spress\Plugin\EventSubscriber;

class YourPlugin extends Plugin
{
    public function initialize(EventSubscriber $subscriber)
    {
       $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart(Event\EnvironmentEvent $event)
    {
        
    }
}
```

## Distributable plugin with Packagist

If you want to create a distributable plugin with Packagist, you need to add a `composer.json` file.
This is the common case for reusable plugins but you can to distribute your plugin with manual download
to `_plugins` folder of a site.

```
_plugins/
|- YourPlugin
|  |- YourPlugin.php
|  |- composer.json
```

The aspect of your `composer.json` is like this:

```
{
    "name": "vendor/YourPlugin",
    "type": "spress-plugin",
    "description": "The description",
    "license": "MIT",
    "authors": [
        {
            "name": "Victor Puertas",
            "email": "vpgugr@gmail.com",
            "homepage": "http://yosymfony.com"
        }
    ],
    "require": {
        "yosymfony/spress-installer": "~1.0"
    },
    "extra": {
        "spress_name": "Your-plugin"
    }
}
```
I should also like to point out the optionality of `spress_class` key at `extra` option. In prior versions
this key was mandatory. Now you can to use this key to set up the entry-point of your plugins if you are using
namespaces.

## Early access
If you want get early access to Spress 1.1.0 you can clone the repository:
`$ git clone https://github.com/yosymfony/Spress.git` or using Composer command:

Create a `composer.json` file in your project root:

```
{
    "require": {
        "yosymfony/spress": "1.1.*@dev"
    }
}
```

and install:
```
php composer.phar install
```