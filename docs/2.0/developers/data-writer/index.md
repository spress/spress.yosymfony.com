---
layout: page-dev-2.0
title: Developers &#8250; Data writer
description: Data writer to persist the content of the items
header: 
  title: Data writer
  sub: Developers
prettify: true
---
The responsibility of *data writer* is to persist the content of the items in filesystem, memory, database or another storage system. Spress comes with `FilesystemDataWriter` out of the box. A data writer must implement [`DataWriterInterface`](https://github.com/spress/Spress/blob/master/src/Core/DataWriter/DataWriterInterface.php):

```
namespace Yosymfony\Spress\Core\DataWriter;

interface DataWriterInterface
{
    /**
     * Prepare the place to store.
     * e.g: clean up the output folder.
     */
    public function setUp();

    /**
     * Write a item.
     *
     * @param \Yosymfony\Spress\Core\DataSource\ItemInterface $item
     */
    public function write(ItemInterface $item);

    /**
     * Brings down the connections to the data.
     */
    public function tearDown();
}
```

## Extends Spress with a custom data writer

Extends Spress with a DataWriter from a plugin is straightforward:

* Suscribes to `spress.start` events and gets the EnvironmentEvent object that received as an argument.
* Sets a custom DataWriter: `$environment->setDataWriter($myDataWriter);`