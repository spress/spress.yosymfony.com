---
layout: page-dev-2.0
title: Developers &#8250; Renderizer
description: Renderizer are responsible for formatting items in Spress
header: 
  title: Renderizer
  sub: Developers
prettify: true
---
Renderizer is responsible for formatting items. This can be considered as a template engine.
[`TwigRenderizer`](https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Renderizer/TwigRenderizer.php)
is the default implementation and is based on [Twig](http://twig.sensiolabs.org/).

## How to set a custom renderizer?

A renderizer must
implement [`RenderizerInterface`](https://github.com/spress/Spress/blob/master/src/Core/ContentManager/Renderizer/RenderizerInterface.php).

```
use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

class TestPlugin implements PluginInterface
{
    public function getMetas()
    {
        return [
            'name' => 'Test plugin',
        ];
    }

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart(EnvironmentEvent $event)
    {
        $myRenderizer = new MyRenderizer();
        $event->setRenderizer($myRenderizer);
    }
}
```

## Extending Twig on `TwigRenderizer`

The `spress.start` event enable to [extend Twig with new functions, tags and tests](http://twig.sensiolabs.org/doc/advanced.html).

### Adds a filter

```
use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

class TestPlugin implements PluginInterface
{
    public function getMetas()
    {
        return [
            'name' => 'Test plugin',
        ];
    }

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart(EnvironmentEvent $event)
    {
        $renderizer = $event->getRenderizer();
        $renderizer->addTwigFilter('dummy', function($string){
            return $string . ' (is dymmy) ';
        });
    }
}
```
**How to use?**

{% verbatim %}
```
{{ 'The text' | dummy }}
```
{% endverbatim %}

### Adds a function

```
use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

class TestPlugin implements PluginInterface
{
    public function getMetas()
    {
        return [
            'name' => 'Test plugin',
        ];
    }

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart(EnvironmentEvent $event)
    {
        $renderizer = $event->getRenderizer();
        $renderizer->addTwigFunction('superf', function($string){
            return strtoupper($string);
        });
    }
}
```

**How to use?**

{% verbatim %}
```
{{ superf('the text') }}
```
{% endverbatim %}

### Adds a test

```
use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

class TestPlugin implements PluginInterface
{
    public function getMetas()
    {
        return [
            'name' => 'Test plugin',
        ];
    }

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart(EnvironmentEvent $event)
    {
        $renderizer = $event->getRenderizer();
        $renderizer->addTwigTest('red', function($val){
            return $val == 'red';
        });
    }
}
```

**How to use?**

{% verbatim %}
```
{% if my_value is red %}
...
{% endif %}
```
{% endverbatim %}
