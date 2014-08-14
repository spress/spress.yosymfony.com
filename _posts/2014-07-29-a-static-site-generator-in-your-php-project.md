---
layout: blog/post
title: A static site generator in your PHP projects
description: Spress-core package lets you use a static site generator in your PHP projects
categories: [news]
tags: ['spress-core']
---
The last days I have been working on splitting Spress into [Spress Core](https://github.com/spress/Spress-core) and its ecosystem 
(console commands and others) as I was described in [issue #13](https://github.com/spress/Spress/issues/13).
Now you can include Spress Core in your PHP projects. This feature would be
useful for generating HTML content of a web project that have both dynamic and static responses.

## How to use?

The first step is to add `yosymfony/spress-core` to your `require` section in `composer.json` and to execute
the `composer update` command.

```
{
    "require": {
        "yosymfony/spress-core": "1.1.*@dev"
    }
}
```
--more Read more--

After your dependencies has been updated you can to create a Spress application an parse a site:

```
use Yosymfony\Spress\Core\Application;

class MyClass
{
    public function parseSite()
    {
        $options = [];
        $app = new Application($options);
        $app->parse('/path-to-your-spress-site/');
    }
}
```

The `/path-to-your-spress-site/` is a folder with a [Spress structure](/docs/how-is-work/).
You can see an [example of a Spress site](https://github.com/yosymfony/Spress-example).

## Set the environment information

If your Spress site has environment configuration, you can set the environment's name
with the second argument of `parse` method: 

```
$app->parse('/your-site/', 'prod')
```

With the before example you are setting the production (prod) environment and the options of `config.yml`
will be overridden with the options of `config_prod.yml` of your site.