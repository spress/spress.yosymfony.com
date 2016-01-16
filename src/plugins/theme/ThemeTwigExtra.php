<?php

use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;
use Yosymfony\Spress\Core\Support\ArrayWrapper;

class ThemeTwigExtra implements PluginInterface
{
    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function getMetas()
    {
        return [
            'name' => 'theme/twigextra',
            'description' => 'Twig extra functionalities',
            'author' => 'Victor Puertas',
            'license' => 'MIT',
        ];
    }

    public function onStart(EnvironmentEvent $event)
    {
        $renderizer = $event->getRenderizer();

        $renderizer->addTwigFilter('paginate', function (array $values, $maxPerPage) {
            return (new ArrayWrapper($values))->paginate($maxPerPage);
        });
    }
}
