---
layout: blog/post
title: New in Spress 1.1: debug mode
description: With debug mode activated you can dump information about a template variable in your Spress site. 
categories: [news]
tags: ['1.1', 'debug', 'twig', 'dump']
---
A debug mode can be activated with Spress 1.1 according with [issue #17](https://github.com/spress/Spress/issues/17)
from [@valllabh](https://github.com/valllabh). With this mode activated you can
[dump](http://twig.sensiolabs.org/doc/functions/dump.html) information about a template
variable in your templates. By default debug mode is disabled. To enable add this line in `config.yml` of your
site:

```
debug: true
```

To dumps information about a variable simply uses `dump` function from Twig:

{% verbatim %}
```
{{ dump(page) }}
```
{% endverbatim %}

Enjoy it!