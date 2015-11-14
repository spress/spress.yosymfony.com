---
layout: page-dev-2.0
title: Developers &#8250; Converters
description: Generators for creating new content
header: 
  title: Generators
  sub: Developers
prettify: true
---
Generators are used for generating new items of content. **Generators can be used to create a
tag or category index page dynamically**. A good example of that is [`PaginationGenerator`](https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Generator/Pagination/PaginationGenerator.php)
whose responsibility is to generate multiple pages around a set of items like posts or any other collection.
A Generator must implement [`GeneratorInterface`](https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Generator/GeneratorInterface.php).

## Generator example

```
class generatorExample implements GeneratorInterface
{
    
    /**
     * Generate items.
     *
     * @param Yosymfony\Spress\Core\DataSource\ItemInterface $templateItem 
     * @param array                                          $collecions
     *
     * @return Yosymfony\Spress\Core\DataSource\ItemInterface[]
     */
    public function generateItems(ItemInterface $templateItem, array $collections)
    {
        $result = [];
        
        return $result;
    }
}
```
## Predefined generators

[`PaginationGenerator`](https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Generator/Pagination/PaginationGenerator.php) and 
[`TaxonomyGenerator`](https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Generator/Taxonomy/TaxonomyGenerator.php) are the predefined generators. TaxonomyGenerator lets you group some items around a term. This generator uses PaginatorGenerator for generating multiple pages for each term.