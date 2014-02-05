---
layout: page-dev
title: Converters
header: { title: Developers, sub: Converters }
prettify: true
---
Converter can to extend Spress to support new type of content. A converter should
implement [`Yosymfony\Spress\ContentManager\ConverterInterface`][ConverterInterface]:

## Converter example

This converter turn to uppercase all content of your 
pages and only work with files with extension is `.up` like `myPage.up` or
`2014-01-02-my-post.up`.

```
use Yosymfony\Spress\ContentManager\ConverterInterface;

class CustomConverter implements ConverterInterface
{
    private $supportExtension = ['up'];
    
    /**
     * Initialize the converter
     * 
     * @param array $config Configuration parameters
     */
    public function initialize(array $config)
    {
    }
    
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
     * Get the support extension of the converter.
     * Add a new processable extension to Spress.
     * 
     * @return array
     */
    public function getSupportExtension()
    {
        return $this->supportExtension;
    }
    
    /**
     * If file's extension is support by converter
     * 
     * @param string $extension Extension without dot
     * 
     * @return boolean
     */
    public function matches($extension)
    {
        return in_array($extension, $this->supportExtension);
    }
    
    /**
     * Convert the input data
     * 
     * @param string $input The raw content without Front-matter
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

## Register a converer

To register a converter see 
[EnviromentEvent class](/docs/developers/events-list/#add-new-converter) from
`spress.start` event.

[ConverterInterface]: https://github.com/yosymfony/Spress/blob/master/src/Yosymfony/Spress/ContentManager/ConverterInterface.php