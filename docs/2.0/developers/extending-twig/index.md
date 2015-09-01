---
layout: page-dev-2.0
title: Developers &#8250; Extending Twig
description: How to extend Twig in Spress
header: { title: Developers, sub: Extending Twig }
prettify: true
---

The `spress.start` event enable to extend [Twig](http://twig.sensiolabs.org/)
with new functions, tags and test.

## Add a filter

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        $event->addTwigFilter('dummy', function($string){
            return $string . ' (is dymmy) ';
        });
    });
```

**How to use?**:
{% verbatim %}
```
{{ 'The text' | dummy }}
```
{% endverbatim %}

## Add a function

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        $event->addTwigFunction('superf', function($string){
            return strtoupper($string);
        });
    });
```

**How to use?**:
{% verbatim %}
```
{{ superf('the text') }}
```
{% endverbatim %}

## Add a test

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        $event->addTwigTest('red', function($val){
            return $val == 'red';
        });
    });
```

**How to use?**:
{% verbatim %}
```
{% if my_value is red %}
...
{% endif %}
```
{% endverbatim %}
