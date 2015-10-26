---
layout: page-dev
title: Developers &#8250; Converters
description: How to extend Spress to support a new markup language
header: { title: Developers, sub: Converters }
prettify: true
---
Converters can extend Spress to support a new markup language. Spress comes with 
two Markdown converters: `ParsedownConverter` an implementation based on [Parsedown](http://parsedown.org/) 
and another implementation called `MichelfMarkdownConverter` based on a [parser from Michel Fortin](https://github.com/michelf/php-markdown). Both are implemented using this method. A converter should implement
[`ConverterInterface`](https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Converter/ConverterInterface.php).

To register a new converter see [EnvironmentEvent class](/docs/2.0/developers/events-list/#adds-new-converter)
at `spress.start` event.

## Converter example

This converter turn to uppercase all content of your 
pages and only work with files which extension is `.up` like `myPage.up` or
`2014-01-02-my-post.up`:

<script src="https://gist.github.com/yosymfony/d838bae6f251b4ed604c.js"></script>
