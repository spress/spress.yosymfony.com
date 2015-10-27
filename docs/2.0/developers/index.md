---
layout: page-dev-2.0
title: Developers &#8250; Create a plugin
description: Getting started with Spress plugins
header: { title: Developers, sub: Create a plugin }
prettify: true
---
Spress can be extended by plugins located in `./src/plugins` folder. Spress uses a 
events mechanic to dispatch events and the plugins can add event listeners.
It’s easy to manually create plugins
but Spress provides a `new:plugin` generator command:

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

## Create a plugin manually {#manual-plugins}

We recommend to use `new:plugin` command but if you want... you can do it by hand. 
It's recommended to create each plugin in a separate folder and with a 
`composer.json` file. With Composer, you can create reusable plugins available to 
others using [packagist.org](https://packagist.org/) and [Github](https://github.com/).

Here you can see an [example](https://github.com/spress/Github-metadata-plugin) of a plugin.

### Plugin skeleton {#plugin-skeleton}

This is the typical structure of a plugin:

```
.
├── src
└── plugins
    ├── YourPluginName
    │   ├── LICENSE
    │   ├── YourPluginName.php
    │   └── composer.json
```

#### Plugin PHP file {#plugin-phpfile}

In your new plugin PHP file you need to create class with the same name as the file.

#### composer.json {#composer-json}

The `composer.json` file contains information about your plugin like name, 
entry-point class or other libraries required by it.

```
{
    "name": "vendor/your-plugin-name",
    "type": "spress-plugin",
    "description": "your plugin description",
    "keywords": ["spress", "plugin"],
    "license": "MIT",
    "authors": [
        {
            "name": "your name",
            "email": "your@email.com"
        }
    ],
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

Your plugin class have to implement Spress `PluginInterface` interface. 
Required methods are:

* `initialize` method where you add your events to event listener. 
* `getMetas` method storing plugin metadata

`initialize` will be invoked at the beginning of the 
plugin life cycle. You can use it like a plugin constructor to initialize internal 
variables.

Below example uses closure to process event, but you can also use [class methods](#class-methods) for your logic.

```
use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

class YourPluginName implements PluginInterface
{
    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 
            function(EnvironmentEvent $event)
            {
                // Event's code
            });
    }
    
    public function getMetas()
    {
        return [ "name" => "YourPluginName", ];
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
                See [Events list](/docs/2.0/developers/events-list).
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
use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

class YourPluginName implements PluginInterface
{
    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }
    
    public function onStart(EnvironmentEvent $event)
    {
        // Code for handle event.
    }    
    
    public function getMetas()
     {
         return [ "name" => "YourPluginName", ];
     }
}
```
