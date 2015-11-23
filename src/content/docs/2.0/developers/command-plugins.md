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
---
<span class="label label-success">Spress >= 2.0</span>

Spress 2 can be extended with command plugins a new kind of plugin which provides
subcommand for spress executable. These kind of plugin is not available with
Spress core only CLI. Each command plugin must extends
[Yosymfony\Spress\Plugin\CommandPlugin](https://github.com/spress/Spress/blob/master/src/Plugin/CommandPlugin.php)
and must to implements getCommandDefinition and executeCommand methods.
Command plugins are only available if you run spress at root site folder.