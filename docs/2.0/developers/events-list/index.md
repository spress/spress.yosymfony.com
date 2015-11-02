---
layout: page-dev-2.0
title: Developers &#8250; Events list
header: { title: Developers, sub: Events list }
description: Events list of Spress livecycle
prettify: true
---
List of Spress events. Even's arguments are located at `Yosymfony\Spress\Core\Plugin\Event`
namespace. All events inherits from 
[Symfony\Component\EventDispatcher\Event][Symfony dispatch event].
[Symfony dispatch event]: http://symfony.com/doc/current/components/event_dispatcher/introduction.html#creating-and-dispatching-an-event

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Event name</th>
            <th>Argument</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>spress.start</td>
            <td markdown="1">[`EnvironmentEvent`](#environmentevent)</td>
            <td>
                The spress.start is thrown when start to generate a project. With this
                event you can:

                <ul>
                    <li>modify the configuration values.</li>
                    <li>add data sources.</li>
                    <li>change the data writer.</li>
                    <li markdown="1">add [converters](/docs/2.0/developers/converters).</li>
                    <li>extend Twig (default renderizer).</li>
                    <li markdown="1">get an access to [IO API](/docs/2.0/developers/io-api).</li>
                </ul>

                When this event is thrown, the site configuration was loaded.
            </td>
        </tr>
        <tr>
            <td>spress.before_convert</td>
            <td markdown="1">[`ContentEvent`](#contentevent)</td>
            <td>
                <p>
                    The spress.before_convert is thrown before convert the content
                    of each page.
                </p>
                <p markdown="1">
                    `getContent()` method returns the original content in
                    source format.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.after_convert</td>
            <td markdown="1">[`ContentEvent`](#contentevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_convert is thrown after convert the content of
                    each page.
                </p>
                <p markdown="1">
                    `getContent()` method returns the content transformed by
                    converter. In this step renderizer tags, like Twig tags, are not resolved.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.before_render_blocks
                <span class="label label-success">New in 2.0.0</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.before_render_blocks is thrown before render content
                    without layouts.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.after_render_blocks
                <span class="label label-success">New in 2.0.0</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_render_blocks is thrown after render content
                    without layouts.
                </p>
                <p markdown="1">
                    `getContent()` method returns the content renderized without layouts applied.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.before_render_page
                <span class="label label-success">New in 2.0.0</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.before_render_page is thrown before render with
                    layouts.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.after_render_page
                <span class="label label-success">New in 2.0.0</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_render_page is thrown after render content
                    with layouts.
                </p>
                <p markdown="1">
                    `getContent()` method returns the content renderized with layouts applied.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.finish</td>
            <td markdown="1">[`FinishEvent`](#finishevent)</td>
            <td markdown="1">
                The spress.finish is thrown when the site was generated. All files 
                are saved in `builder` folder.
            </td>
        </tr>
    </tbody>
</table>

## EnvironmentEvent {#environmentevent}

This class lets you:

<ul>
    <li>modify the configuration values.</li>
    <li>add data sources.</li>
    <li>change the data writer.</li>
    <li>add converters.</li>
    <li>extend Twig (default renderizer).</li>
    <li>get an access to IO API.</li>
</ul>

#### Modifying configuration values

If you want to alter site's configuration you need to get the configuration values
using `getConfigValues` method (returns an array). The method `setConfigValues`
lets you save your changes:

```
<?php

use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

class TestPlugin implements PluginInterface
{
    public function getMetas()
    {
        return [
            'name' => 'Test plugin',
        ];
    }

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart(EnvironmentEvent $event)
    {
        // Configuration values at config.yml file:
        $configValues = $event->getConfigValues();
        $configValues['url'] = 'http://your-domain.local:4000';
        
        $event->setConfigValues($configValues);
    }
}
```

#### Adds a new converter {#adds-new-converter}

Converter can extend Spress to support a new markup language.

```
<?php

use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

class TestPlugin implements PluginInterface
{
    public function getMetas()
    {
        return [
            'name' => 'Test plugin',
        ];
    }

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart(EnvironmentEvent $event)
    {
         $repository = $event->addConverter(new MyConverter());
    }
}
```

More details about [how to create a Converter](/docs/2.0/developers/converters/).

## ContentEvent {#contentevent}

This is a event base for content-related events.

```
$subscriber->addEventListener('spress.before_convert', 
    function(ContentEvent $event)
    {
        // Gets the identifier of the item (string):
        $v = $event->getId();
        
        // Gets the content without Front-matter (string):
        $v = $event->getContent();
        
        // Sets the content of the item:
        $event->setContent('New content');
        
        // Gets the attributes of the item (array):
        $v = $event->getAttributes();

        // Sets the attributes of the item (array):
        $event->setAttributes([`author_name` => 'Victor']);
    });
```

## RenderEvent {#renderevent}

This event extends from [`ContentEvent`](#contentevent).

{% verbatim %}
```
$subscriber->addEventListener('spress.before_render_blocks', 
    function(RenderEvent $event)
    {
        // Gets the relative URL (string):
        $url = $event->getRelativeUrl();

        // Changes the URL (string):
        $event->setRelativeUrl('/about/me/index.html');
    });
```
{% endverbatim %}

## FinishEvent {#finishevent}

Information about the site performed.

```
$subscriber->addEventListener('spress.finish', 
    function(FinishEvent $event)
    {
        // Gets the items (array)
        $items = $event->getItems();

        // (array)
        $siteAttributes = $event->getSiteAttributes();
    });
```
