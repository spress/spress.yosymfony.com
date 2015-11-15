---
layout: page-dev-2.0
title: Developers &#8250; Converters
description: How to extend Spress to support a new markup language
header: 
  title: Converters
  sub: Developers
prettify: true
---
Converters can extend Spress to support a new markup language. Spress comes with 
two Markdown converters: `ParsedownConverter` an implementation based on [Parsedown](http://parsedown.org/) 
and another implementation called `MichelfMarkdownConverter` based on a [parser from Michel Fortin](https://github.com/michelf/php-markdown). Both are implemented using this method. A converter should implement
[`ConverterInterface`](https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Converter/ConverterInterface.php).

Note that `ParsedownConverter` is not part of Spress core and only is available on CLI interface.

To register a new converter see [EnvironmentEvent class](/docs/2.0/developers/events-list/#adds-new-converter)
at `spress.start` event.

## Converter example

This converter turn to uppercase all content of your 
pages and only work with files which extension is `.up` like `myPage.up` or
`2014-01-02-my-post.up`:

```
<?php

namespace Yosymfony\Spress\Converter;

use Yosymfony\Spress\Core\ContentManager\Converter\ConverterInterface;

class UpperConverter implements ConverterInterface
{
    private $supportedExtension;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->supportedExtension = ['up'];
    }

    /**
     * Get the converter priority.
     * 
     * @return int Value between 0 to 10. Greater means higher priority.
     *             Built-in converters have low priority.
     */
    public function getPriority()
    {
        return 1;
    }

    /**
     * If file's extension is support by converter.
     *
     * @param string $extension Extension without dot.
     *
     * @return bool
     */
    public function matches($extension)
    {
        return in_array($extension, $this->supportedExtension);
    }

    /**
     * Convert the input data.
     *
     * @param string $input The raw content without Front-matter.
     *
     * @return string
     */
    public function convert($input)
    {
        return strtoupper($input);
    }

    /**
     * The extension of filename result (without dot). E.g: html.
     *
     * @return string
     */
    public function getOutExtension($extension)
    {
        return 'html';
    }
}
```
