---
layout: blog/post
title: "A site variable with items matching a criteria"
description: "How to expose a new site variable items that maching a criteria"
categories: ["resources", "plugin"]
---
There are certain situations in which it is necessary to have available a site variable (those that are accessible using `site.xxx`)
with the items that matching certain criteria. In this post, I will explain how to expose a new site variable with
items that contains an `categories` attribute.

--more Read more--

The following code is a Spress plugin called `ThemeCategoryItems`. The data of items matching
a criteria are accessible at `site.category_items`. This variable contains an array of elements
with the typical data of an [item](/docs/variables#page-variables): id, url, collection... etc.

Paste the following code into `src\plugins\ThemeCategoryItems.php` file:

```php
<?php

use Yosymfony\Spress\Core\DataSource\ItemInterface;
use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;
use Yosymfony\Spress\Core\Plugin\Event\ContentEvent;
use Yosymfony\Spress\Core\Plugin\Event\RenderEvent;

class ThemeCategoryItems implements PluginInterface
{
    private $categoryItems = [];
    private $items = [];
    private $firstRenderEvent = true;

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
        $subscriber->addEventListener('spress.after_convert', 'onAfterConvert');
        $subscriber->addEventListener('spress.before_render_blocks', 'onBeforeRenderBlocks');
        $subscriber->addEventListener('spress.after_render_blocks', 'onAfterRenderBlocks');
    }

    public function getMetas()
    {
        return [
            'name' => 'theme/category-items',
            'description' => 'Plutgin for expanding category aggregation',
            'author' => 'Yo! Symfony',
            'license' => 'MIT',
        ];
    }
    
    public function onStart(EnvironmentEvent $event)
    {
        $configValues = $event->getConfigValues();
        $configValues['category_items'] = &$this->categoryItems;

        $event->setConfigValues($configValues);
    }

    public function onAfterConvert(ContentEvent $event)
    {
        $attributes = $event->getAttributes();

        if (isset($attributes['categories'])) {
            $this->items[$event->getId()] = $event->getItem();
        }
    }

    public function onBeforeRenderBlocks(RenderEvent $event)
    {
        if ($this->firstRenderEvent) {
            $this->updateSiteVariables();
            $this->firstRenderEvent = false;
        }
    }

    public function onAfterRenderBlocks(RenderEvent $event)
    {
        if (isset($this->items[$event->getId()])) {
            $this->updateSiteItem($event->getItem());
        }
    }

    private function updateSiteVariables()
    {
        foreach ($this->items as $item) {
            $this->updateSiteItem($item);
        }
    }

    private function updateSiteItem($item)
    {
        $attributes = $item->getAttributes();
        $attributes['id'] = $item->getId();
        $attributes['content'] = $item->getContent();
        $attributes['collection'] = $item->getCollection();
        $attributes['path'] = $item->getPath(ItemInterface::SNAPSHOT_PATH_RELATIVE);

        $this->categoryItems[$item->getId()] = $attributes;
    }
}
```

Next, I will to explains the key aspects of the prior plugin.

In order to add a new site variable you need to get the configuration values and add a new one.
Configuration values are availables in [`spress.start` event](/docs/developers/events-list).

```
public function onStart(EnvironmentEvent $event)
{
    $configValues = $event->getConfigValues();
    $configValues['category_items'] = &$this->categoryItems;

    $event->setConfigValues($configValues);
}
```

The variable `categoryItems` will contains the data of matched items. Note that is assigned as a pointer for
keeping data up to date.

The next snippet of code only be executed one time for updating `url` and `collection` attributes prior to render them.
More details about [Spress's lifecyle](/docs/developers/spress-lifecycle).

```
public function onBeforeRenderBlocks(RenderEvent $event)
{
    if ($this->firstRenderEvent) {
        $this->updateSiteVariables();
        $this->firstRenderEvent = false;
    }
}
```

The goal of `updateSiteItem` method is to compose the attributes availables
for each item in `categoryItems` array:

```
private function updateSiteItem($item)
{
    $attributes = $item->getAttributes();
    $attributes['id'] = $item->getId();
    $attributes['content'] = $item->getContent();
    $attributes['collection'] = $item->getCollection();
    $attributes['path'] = $item->getPath(ItemInterface::SNAPSHOT_PATH_RELATIVE);

    $this->categoryItems[$item->getId()] = $attributes;
}
```

## How access to the results?

In a page, paste the following code:

{% verbatim %}
```twig
<ul>
{% for item in site.category_items %}
    <li><a href="{{ item.url }}">{{ item.title }}</a></li>
{% endfor %}
</ul>
```
{% endverbatim %}
