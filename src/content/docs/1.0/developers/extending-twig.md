---
layout: page-dev
title: Developers &#8250; Extending Twig
description: How to extend Twig in Spress
header:
  title: Extending Twig
  sub: Developers
menu:
  id: dev 1.0
  title: Extending Twig
  order: 5
prettify: true
---

The `spress.start` event enables you to extend [Twig](http://twig.sensiolabs.org/)
with new functions, tags and tests.

## Add a filter {#add-filter}

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        $event->addTwigFilter('dummy', function($string){
            return $string . ' (is dummy) ';
        });
    });
```

**Usage in template**:
{% verbatim %}
```
{{ 'The text' | dummy }}
```
{% endverbatim %}

## Add a function {#add-function}

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        $event->addTwigFunction('superf', function($string){
            return strtoupper($string);
        });
    });
```

**Usage in template**:
{% verbatim %}
```
{{ superf('the text') }}
```
{% endverbatim %}

## Add a test {#add-test}

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        $event->addTwigTest('red', function($val){
            return $val == 'red';
        });
    });
```

**Usage in template**:
{% verbatim %}
```
{% if my_value is red %}
...
{% endif %}
```
{% endverbatim %}
