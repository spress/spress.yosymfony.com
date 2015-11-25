---
layout: page-dev-2.0
title: Developers &#8250; Command plugins
description: Create subcommand for Spress executable.
header: 
  title: Command plugins
  sub: Developers
menu:
  id: dev 2.0
  title: Command plugins
  order: 9
prettify: true
---
<span class="label label-success">Spress >= 2.0</span>

Spress 2 can be extended with command plugins, a new kind of plugin which provides
subcommand for spress executable. These kind of plugin is not available with
Spress core only CLI. Each command plugin must extends
[`Yosymfony\Spress\Plugin\CommandPlugin`](https://github.com/spress/Spress/blob/master/src/Plugin/CommandPlugin.php)
and must to implements getCommandDefinition and executeCommand methods.
Command plugins are only available if you run spress at root site folder.

## An example

This example has been created using `$ spress new:plugin` command. This command's mission is just to say hello.

`getCommandDefinition` returns the command's definition. The name of a command is the basic definition:
`$definition = new CommandDefinition('hello')`. Additionally you can set a description text, a help text 
and a set of arguments and options.

```
$definition = new CommandDefinition('hello');
$definition->addArgument('file', null, 'File or directory', './');
$definition->addOption('filter', 'f', null, 'Filter expression');
```

**Notice** that `CommandPlugin` inherited from [`Yosymfony\Spress\Core\Plugin\PluginInterface`](https://github.com/spress/Spress/blob/master/src/Core/Plugin/PluginInterface.php)
and therefore is a regular plugin. This mean that you can add `initialize` method.

```
<?php

use Yosymfony\Spress\Core\IO\IOInterface;
use Yosymfony\Spress\Plugin\CommandDefinition;
use Yosymfony\Spress\Plugin\CommandPlugin;

class ExampleSayHello extends CommandPlugin
{
    /**
     * Gets the command's definition.
     *
     * @return \Yosymfony\Spress\Plugin\CommandDefinition Definition of the command.
     */
    public function getCommandDefinition()
    {
        $definition = new CommandDefinition('hello');
        $definition->setDescription('Say hello');
        $definition->setHelp('Say hello');

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
        $io->write("Hello");
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
            'name' => 'example/say-hello',
            'description' => 'Say hello',
            'author' => 'Victor Puertas',
            'license' => 'MIT',
        ];
    }
}
```
