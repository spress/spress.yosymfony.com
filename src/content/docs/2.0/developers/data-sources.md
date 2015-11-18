---
layout: page-dev-2.0
title: Developers &#8250; Data sources
description:  Data sources can load data fromcertain locations like filesystem or database
header: 
  title: Data sources
  sub: Developers
menu:
  id: dev 2.0
  title: Data sources
  order: 4
prettify: true
---
<span class="label label-success">Spress >= 2.0</span>

Data sources can load data from certain locations like filesystem or database.
Every data source must extends `AbstractDataSource`. Data loaded from data sources are
called items. There is three type of them: content, layout and include.
Items must implements [`ItemInterface`](https://github.com/spress/Spress/blob/master/src/Core/DataSource/ItemInterface.php).

## Items {#items}

Items are the basic building blocks and consist of content and metadata attributes.
Each item has an identifier and a set of attributes (metadatas). Attributes consist of
*key-value* array. [`FilesystemDataSource`](https://github.com/spress/Spress/blob/master/src/Core/DataSource/Filesystem/FilesystemDataSource.php) implementation is able
to load attributes located at the [front-matter](/docs/2.0/front-matter/) or in a separeted
metadata file which are stored in [YAML format](https://en.wikipedia.org/wiki/YAML).

### How to create an item?

```
use Yosymfony\Spress\Core\DataSource\Item;

$item = new Item('Test of content', 'myPage.md', ['title' => 'My page']);
```

`Item` is an implementation of `ItemInterface`. First argument is the content, second is the identifier
and last one are the attributes.

To get and set attributes uses `getAttributes` and `setAttributes` methods:

```
use Yosymfony\Spress\Core\DataSource\Item;

$item = new Item('Test of content', 'myPage.md', ['title' => 'My page']);

$attributes = $item->getAttributes();
$attributes['parmalink'] = '/my-page'

$item->setAttributes($attributes);
```

### Setting the paths

Item's paths are organized around *snapshots* that define a path at a specific point
of compilation a site. An item without `relative` path snapshot will be compiled but not
stored by the [data writer](/docs/2.0/developers/data-writer).

Predefined snapshots:

* **relative**:  defines the relative route of the item in the site. This is an important snapshot because it will be used as the basis for generating the permalink.
* **permalink**: generated automatically by *permalink generator*. Constains the relative URL.
* **source**: in case of binary content, contains the real path to the item. This improve the performance because the file will be copied instead of dumping the content from memory.
* **last**: the most recent path snapshot.

```
use Yosymfony\Spress\Core\DataSource\Item;

$item = new Item('Test of content', 'about.md', []);
$item->setPath('help/about.md', 'relative');
$item->getPath('relative');
```

First argument of `setPath` method is the path and the second argument is the snapshot's name.
`getPath` method recovers the path of associated to a snapshot. If you call to `getPath` method
without arguments you will get the `last` snapshot.

Predefined snapshots are defined as constants:

* `ItemInterface::SNAPSHOT_PATH_RELATIVE`
* `ItemInterface::SNAPSHOT_PATH_PERMALINK`
* `ItemInterface::SNAPSHOT_PATH_LAST`
* `ItemInterface::SNAPSHOT_PATH_SOURCE`

### Binary content

If the extension of the item is included in the site configuration’s `text_extension` attribute, it is considered to be
textual. Otherwise it will be considered as binary. More details about [text_extension value](/docs/2.0/configuration/#deafult-configuration).

```
use Yosymfony\Spress\Core\DataSource\Item;

$item = new Item('', 'assets/img/header.png', [], true);
$item->setPath('assets/img/header.png', 'relative');
$item->setPath('assets/img/header.png', 'source');  
```

The last one argument of the constructor indicates that content is binary. At the prior example, the items
has defined `relative` and `source` snapshots. This mean that [`FilesystemDataWriter`](/docs/2.0/developers/data-writer/#FilesystemDataWriter)
will copied from `source` path to `relative` path at `./build` folder.

#### Binary items without `relative` path snapshot

```
use Yosymfony\Spress\Core\DataSource\Item;

$binaryContent = $assetsManager->getImage('logo');

$item = new Item($binaryContent, 'assets/img/header.png', [], true);
$item->setPath('assets/img/header.png', 'relative');
```
In this case, [`FilesystemDataWriter`](/docs/2.0/developers/data-writer/#FilesystemDataWriter)
will dump the content from memory to the file at the moment of storing the item.

### Type of items

There is three type of item:

* **content**: (default) regular content like post or pages.
* **layout**: indicates how to organize the content.
* **include**: reusable content.

The Item's constructor accept a fifth argument for the type:

{% verbatim %}
```
use Yosymfony\Spress\Core\DataSource\Item;

$layoutItem = new Item('{{ page.content }}', 'page.html', [], false, ItemInterface::TYPE_LAYOUT);
```
{% endverbatim %}

Item types are defined as constants:

* `ItemInterface::TYPE_ITEM`
* `ItemInterface::TYPE_LAYOUT`
* `ItemInterface::TYPE_INCLUDE`


### Content snapshots

A snapshot is the compiled content at a specific point during the compilation process.
Following, a list of predefined content snapshots, mostly of they are generated automatically:

* **raw**: the content right before actual compilation is started.
* **after_convert**: the content right after converter was applied.
* **after_render_blocks**: the content right after rederizer was applied **without layouts**.
* **after_render_page**: the content right after rederizer was applied **with layouts**.
* **last**: the most recent compiled content.

Predefined snapshots are defined as constants:

* `ItemInterface::SNAPSHOT_RAW
* `ItemInterface::SNAPSHOT_LAST`
* `ItemInterface::SNAPSHOT_AFTER_CONVERT`
* `ItemInterface::SNAPSHOT_AFTER_RENDER_BLOCKS`
* `ItemInterface::SNAPSHOT_AFTER_PAGE`

Usually, binary items don't have content snapshots.

The below example show you how to get the content:

```
use Yosymfony\Spress\Core\DataSource\Item;

$item = new Item('The content', 'index.html');

$a = $item->getContent();
$b = $item->getContent('last');
$c = $item->getContent('raw');

$item->setContent('New content', 'custom-snapshot');
```

In this case, `$a = $b = $c`. When you create a new item initial content is available at `raw` and `last`
snapshots. By default `getContent` method returns the `last` snapshot.

To set content uses `setContent` method. The first argument is the content and the last one is the snapshot name.

## Predefined data sources

### FilesystemDataSource {#FilesystemDataSource}

Spress comes with [`FilesystemDataSource`](https://github.com/spress/Spress/blob/master/src/Core/DataSource/Filesystem/FilesystemDataSource.php) to load your site.
Data sources are defined at `data_source` option at site configuration file:

```yaml
data_sources:
  filesystem:
    class: 'Yosymfony\Spress\Core\DataSource\Filesystem\FilesystemDataSource'
    arguments:
      source_root: '%site_dir%/src'
      include: '%include%'
      exclude: '%exclude%'
      text_extensions: '%text_extensions%'
      attribute_syntax: '%attribute_syntax%'
```
This is the **default configuration** and is not necessary to modify your `config.yml` file at your site.

### MemoryDataSource {#MemoryDataSource}

[`MemoryDataSource`](https://github.com/spress/Spress/blob/master/src/Core/DataSource/Memory/MemoryDataSource.php)
is useful for generating dynamic content.
At the below example the permalink of the item will be `/welcome` and its path `/welcome/index.html`
at the compiled site:

```
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

        $item = new Item('# Welcome!', 'welcome.md');
        $item->setPath('welcome.md', Item::SNAPSHOT_PATH_RELATIVE);

        $memoryDataSource = new MemoryDataSource();
        $memoryDataSource->addItem($item);

        $dsm->setDataSource('memory-plugin', $memoryDataSource);
    }
}
```

To adds a new layout or include item uses `addLayout` and `addInclude` methods:

{% verbatim %}
```
$include = new Item('<div>{{ page.content }}<div>');

$memoryDataSource = new MemoryDataSource();
$memoryDataSource->addInclude($item);

```
{% endverbatim %}
