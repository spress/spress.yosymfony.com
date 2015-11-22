---
layout: page-dev-2.0
title: Developers &#8250; Events list
description: Events list of Spress 2.x livecycle
header: 
  title: Events list
  sub: Developers
menu:
  id: dev 2.0
  title: Events lists
  order: 3
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
                    <li markdown="1">[modify the configuration values](#modifying-configuration).</li>
                    <li markdown="1">managing [data sources](#managing-data-sources).</li>
                    <li markdown="1">change the [data writer](#changing-data-writer).</li>
                    <li markdown="1">add [converters](#adds-new-converter).</li>
                    <li markdown="1">managing [generators](#managing-generators).</li>
                    <li markdown="1">change the renderizer.</li>
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
                <span class="label label-success">Spress >= 2.0.0</span>
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
                <span class="label label-success">Spress >= 2.0.0</span>
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

* modify the configuration values.</li>
* add data sources.
* change the data writer.
* add a converters.
* change the renderizer.
* get an access to IO API.

#### Modifying configuration values {#modifying-configuration}

If you want to alter site's configuration you need to get the configuration values
using `getConfigValues` method (returns an array). The method `setConfigValues`
lets you save your changes:

```
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

#### Managing data sources {#managing-data-sources}

Each site would have one or more *data sources*. Data sources can load data (items, layouts and includes) from
certain locations like filesystem or database. Additionally data sources lets you create dynamic content
using an special data source called [MemoryDataSource](/docs/2.0/developers/data-sources/#memoryDataSource).

The below example show you how to add a new data source. The first argument of `addDataSource` method is 
the name for the new data source:

```
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
         $dsm = $event->getDataSourceManager();
         $dsm->addDataSource('my-custom-data-source', new MyDataSource());
    }
}
```

`DataSourceManager` has methods to add, edit and delete data sources.
More details about [how to manage data sources](/docs/2.0/developers/data-sources/).

#### Changing the data writer {#changing-data-writer}

The data writer is responsible for provinding the persistence layer to items. By defatult
Spress uses a filesystem data writer implementation but is easy to create a custom
data writer for persisting items in a data base for example.

```
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
        $event->setDataWriter(new MyDataWriter());
    }
}
```
To get the current instance of the data writer invokes the method `$event->getDataWriter()`.

More details about [data writer](/docs/2.0/developers/data-writer/).

#### Adds a new converter {#adds-new-converter}

Converter can extend Spress to support a new markup language.

```
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
         $event->getConverterManager()->addConverter(new MyConverter());
    }
}
```

More details about [how to create a Converter](/docs/2.0/developers/converters/).

#### Managing generators {#managing-generators}

Each site would have one or more [generators](/docs/2.0/developers/generators).
Generators are used for generating new items of content.

```
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
         $generatorManager = $event->getGeneratorManager();
         $generatorManager->addGenerator('myGenerator', new MyGenerator());
    }
}
```
More details about how to create a [generators](/docs/2.0/developers/generators).

## ContentEvent {#contentevent}

This is a event base for content-related events. Generators can be used to create
a tag or category index page dynamically.

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
