---
layout: page-dev-2.0
title: Developers &#8250; Data writer
description: Data writer to persist the content of the items
header: 
  title: Data writer
  sub: Developers
prettify: true
---
<span class="label label-success">Spress >= 2.0</span>

The responsibility of *data writer* is to persist the content of the items in filesystem, memory, database or another storage system.

## FilesystemDataWriter {#FilesystemDataWriter}

[`FilesystemDataWriter`](https://github.com/spress/Spress/blob/master/src/Core/DataWriter/FilesystemDataWriter.php)
is the default data writer and its responsability is to persist items to filesystem.
A data writer must implement 
[`DataWriterInterface`](https://github.com/spress/Spress/blob/master/src/Core/DataWriter/DataWriterInterface.php).

To change the current data writer see [EnvironmentEvent class](/docs/2.0/developers/events-list/#changing-data-writer)
at `spress.start` event.

## Data writer example

`ArrayDataWriter` is a simple implementation for writing items in an array:

```
use Yosymfony\Spress\Core\DataSource\ItemInterface;

class ArrayDataWriter implements DataWriterInterface
{
    protected $items = [];

    /**
     * Prepare the place to store.
     * e.g: clean up the output folder.
     */
    public function setUp()
    {
        $this->items = [];
    }

    /**
     * Write a item.
     *
     * @param \Yosymfony\Spress\Core\DataSource\ItemInterface $item
     */
    public function write(ItemInterface $item)
    {
        $this->items[$item->getId()] = $item;
    }

    /**
     * Gets the items.
     * This is not a member of DataWriterInterface.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Where you clean up the objects.
     * e.g: brings down the connections to the data.
     */
    public function tearDown()
    {
        // do not nothing in this case
    }
}
```
