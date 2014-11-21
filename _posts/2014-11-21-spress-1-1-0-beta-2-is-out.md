---
layout: blog/post
title: "Spress 1.1.0 beta 2 is out"
categories: [releases]
tags: [1.1.0]
---
Hi again. The second and last beta of Spress 1.1.0 has been released. The main feature included in this release are two new commands for scaffolding plugins and posts: `new:post` and `new:plugin`. Another new goodies are included like
Issue [#17](https://github.com/spress/Spress/issues/17): [Twig debug mode](/news/2014/10/28/new-in-spress-1-1-debug-mode/) through configuration proposed by [@valllabh](https://github.com/valllabh).

## Scaffolding commands

By default, the commands interacts with the user to tweak the generation. Any passed option will be used as a default value for the interaction. The command `site:new` has been declared deprecated and replaced by `new:site.

### new:post

The `new:post` command helps you generates new posts.

`new:post [--title="..."] [--layout="default"] [--date="..."] [--tags="..."] [--categories="..."]`

* `--title`: The title of the post.
* `--layout`: The layout of the post.
* `--date`: The date assigned to the post.
* `--tags`: Tags list separed by white spaces.
* `--categories`: Categories list separed by white spaces.

Example: 
```
$>spress new:post
```

--more Rear more--

### new:plugin

The `new:plugin` command helps you generates new plugins.

`new:plugin [--name="..."] [--author="..."] [--email="..."] [--description="..."] [--license="MIT"]`

* `--name`: The name of the plugins should follow the pattern `vendor-name/plugin-name`.
* `--author`: The author of the plugin.
* `--email`: The Email of the author.
* `--description`: The description of your plugin.
* `--license`: The license under you publish your plugin. MIT by default.

Example: 
```
$>spress new:plugin
```

Enjoy it!