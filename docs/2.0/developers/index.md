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
new:plugin  [--name="..."] [--command-name="..."] [--command-description="..."]
            [--command-help="..."] [--author="..."] [--email="..."]
            [--description="..."] [--license="MIT"]
```

* `--name`: The name of the plugin should follow the pattern `vendor-name/plugin-name`.
* `--command-name`: In case of you want to create a [command plugin](#command-plugin) this is the name of the command.
* `--command-description`: The description of command in case of command plugin.
* `--command-help`: The description of command in case of command plugin.
* `--author`: The author of the plugin.
* `--email`: The Email of the author.
* `--description`: The description of your plugin.
* `--license`: The license under you publish your plugin. MIT by default.

Notes that if you want to create a command plugin, `--command-name` is mandatory.

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
        "yosymfony/spress-installer": "~2.0"
    }
}
```

An overview of what main options mean:

* **type**: This is the package type. For Spress plugins must be set to `spress-plugin`.
* **require**: List of other packages required by the plugin. **If you want to make
a public plugin then you must add the `spress-installer` to the required list**.
* **extra**: Extra information for Composer about the plugin is mandatory.

**Get your plugin requirements and generate class-loader**

Go to your site folder and run `composer update` command.

## The plugin {#plugin}

Your plugin class have to implement Spress `PluginInterface` interface. 
Required methods are:

* `initialize` method where you add your events to event listener. 
* `getMetas` method returns an array with the plugins's metadata.

### initialize method {#initialize-method}

This method will be invoked at the beginning of the plugin's life cycle.
You can use it like a plugin constructor to initialize internal variables.

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

The `addEventListener($eventName, $listener)` method adds a new listener to an event:

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

### getMetas method {#getMetas method}

This method returns an array with the plugins's metadata. List of the standard metas:

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
            <td>name</td>
            <td>string</td>
            <td>
                The name of the plugin.
            </td>
        </tr>
        <tr>
            <td>description</td>
            <td>string</td>
            <td>
                A brief description of the plugin.
            </td>
        </tr>
        <tr>
            <td>author</td>
            <td>string</td>
            <td>
                The author of the plugin.
            </td>
        </tr>
        <tr>
            <td>license</td>
            <td>string</td>
            <td markdown="1">
                The license of the plugin. The recommended notation for the most common licenses are
                listed at [SPDX Open Source License Registry](https://spdx.org/licenses/).
            </td>
        </tr>
    </tbody>
</table>

### Class methods to handle events {#class-methods}

You can use class methods instead of closure function (recommended way):

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
## Command plugin {#command-plugin}

AS of version 2.0.0 Spress can be extended with command plugins, a new kind of plugins which
provide subcommands for spress executable (`.phar` file).
For example command plugins are usefull for writing subcommands for handling i18n concerns.
A command plugin should implement
[`CommandPluginInterface`](https://github.com/spress/Spress/blob/master/src/Plugin/CommandPluginInterface.php).

<img src="{{ site.url }}/assets/img/spress-command-plugin-scaffolding.png" class="img-responsive" alt="Responsive image">

### Example

Below example is a command plugin created with `spress new:plugin`:

```
<?php

use Yosymfony\Spress\Core\IO\IOInterface;
use Yosymfony\Spress\Plugin\CommandDefinition;
use Yosymfony\Spress\Plugin\CommandPlugin;

class Yosymfonytestplugin extends CommandPlugin
{
    /**
     * Gets the command's definition.
     *
     * @return \Yosymfony\Spress\Plugin\CommandDefinition Definition of the command.
     */
    public function getCommandDefinition()
    {
        $definition = new CommandDefinition('test:hello');
        $definition->setDescription('Say hello');
        $definition->setHelp('');

        return $definition;
    }

    /**
     * Executes the current command.
     *
     * @param \Yosymfony\Spress\Core\IO\IOInterface $io Input/output interface.
     * @param array $arguments Arguments passed to the command.
     * @param array $options Options passed to the command.
     *
     * @return null|int null or 0 if everything went fine, or an error code.
     */
    public function executeCommand(IOInterface $io, array $arguments, array $options)
    {
        $io->write("Hello!");
    }

    /**
     * Gets the metas of a plugin.
     * 
     * Standard metas:
     *   - name: (string) The name of plugin.
     *   - description: (string) A short description of the plugin.
     *   - author: (string) The author of the plugin.
     *   - license: (string) The license of the plugin.
     * 
     * @return array
     */
    public function getMetas()
    {
        return [
            'name' => 'yosymfony/test-plugin',
            'description' => '',
            'author' => 'Yo! Symfony',
            'license' => 'MIT',
        ];
    }
}

```
