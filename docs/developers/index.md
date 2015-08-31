---
layout: page-dev
title: Developers &#8250; Create a plugin
description: Getting started with Spress plugins
header: { title: Developers, sub: Create a plugin }
prettify: true
---
Spress can be extended by plugins located in `_plugins` folder. Spress uses a 
events mechanic to dispatch events and the plugins can add event listener.
It’s easy to manually create plugins
but Spress provides a `new:plugin` generator command: <sup><span class="label label-success">New in 1.1.0</span></sup>

```
$ spress new:plugin
```

By default, the command is interactive - you'll have to answer few questions 
to tweak the generation.

The complete syntax of the command is:

```
new:plugin [--name="..."] [--author="..."] [--email="..."] [--description="..."] [--license="MIT"]
```

* `--name`: The name of the plugin should follow the pattern `vendor-name/plugin-name`.
* `--author`: The author of the plugin.
* `--email`: The Email of the author.
* `--description`: The description of your plugin.
* `--license`: The license under you publish your plugin. MIT by default.

## Create a plugins manually {#manual-plugins}

We recommend to use `new:plugin` command but if you want... you can do it by hand.
It's recommended to create each plugin in a separate folder and with a 
`composer.json` file. With Composer, you can create reusable plugins available to 
others using [packagist.org](https://packagist.org/) and [Github](https://github.com/).

Here you can see an [example](https://github.com/spress/Github-metadata-plugin) of a plugin.

### Plugin skeleton {#plugin-skeleton}

This is the typical structure of a plugin:

```
_plugins/
|- YourPluginName/
|  |- composer.json
|  |- YourPluginName.php
```

#### Plugin PHP file {#plugin-phpfile}

In your new plugin PHP file you need to create class with the same name as the file and without namespace.

#### composer.json {#composer-json}

The `composer.json` file contains information about your plugin like name,
entry-point class or other libraries required by it.

```
{
    "name": "vendor/your-plugin-name",
    "type": "spress-plugin",
    "license": "MIT",
    "require": {
        "yosymfony/spress-installer": "~1.0"
    },
    "extra": {
        "spress_name": "YourPluginName"
    }
}
```

An overview of what main options mean:

* **type**: This is the package type. For Spress plugins must be set to `spress-plugin`.
* **require**: List of other packages required by the plugin. **If you want to make
a public plugin then you must add the `spress-installer` to the required list**.
* **extra**: Extra information for Composer about the plugin is mandatory.
* * **spress_name**: The name of the plugin. This value determines the name of the folder where it will be installed.

**Get your plugin requirements and generate class-loader**

Go to your site folder and run `composer update` command.

#### The plugin {#plugin}

Your plugin class have to extend Spress `Plugin` class and should implement `initialize` method
to add event listener. `initialize` will be invoked at the beginning of the 
plugin live cycle. You can use it like a plugin constructor to initialize internal
variables.

```
use Yosymfony\Spress\Plugin\Plugin;
use Yosymfony\Spress\Plugin\EventSubscriber;
use Yosymfony\Spress\Plugin\Event\EnvironmentEvent;

class YourPluginName extends Plugin
{
    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 
            function(EnvironmentEvent $event)
            {
                // Event's code
            });
    }
}
```

The `addEventListener($eventName, $listener)` method adds a new listener to a event:

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Name</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>$eventName</td>
            <td>string</td>
            <td markdown="1">
                The name of the event.
                See [Events list](/docs/developers/events-list).
            </td>
        </tr>
        <tr>
            <td>$listener</td>
            <td>callable</td>
            <td>
                The listener of the event. It may be a closure function or a 
                function name.
            </td>
        </tr>
    </tbody>
</table>

## Class methods to handle events {#class-methods}

You can use class methods instead of closure function:

```
use Yosymfony\Spress\Plugin\Plugin;
use Yosymfony\Spress\Plugin\EventSubscriber;
use Yosymfony\Spress\Plugin\Event\EnvironmentEvent;

class YourPluginName extends Plugin
{
    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }
    
    public function onStart(EnvironmentEvent $event)
    {
        // Code for handle event.
    }
}
```
