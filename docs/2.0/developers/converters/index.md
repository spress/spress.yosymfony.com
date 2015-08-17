---
layout: page-dev
title: Developers &#8250; Converters
description: How to extend Spress with a new converter
header: { title: Developers, sub: Converters }
prettify: true
---
Converter can to extend Spress to support new type of content. A converter should
implement [`Yosymfony\Spress\Core\ContentManager\Converter\ConverterInterface`][ConverterInterface]:

## Converter example

This converter turn to uppercase all content of your 
pages and only work with files with extension is `.up` like `myPage.up` or
`2014-01-02-my-post.up`.

```
use Yosymfony\Spress\Core\ContentManager\Converter\ConverterInterface;

class CustomConverter implements ConverterInterface
{
    private $supportExtension = ['up'];
    
    /**
     * Get the converter priority.
     * Value between 0 to 10 with great is more priority.
     * The converters built-in with Spress have low priority.
     * 
     * @return int
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
     * @return boolean
     */
    public function matches($extension)
    {
        return in_array($extension, $this->supportExtension);
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

## Register a converter

To register a converter see 
[EnvironmentEvent class](/docs/2.0/developers/events-list/#add-new-converter) from
`spress.start` event.

[ConverterInterface]: https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Converter/ConverterInterface.php