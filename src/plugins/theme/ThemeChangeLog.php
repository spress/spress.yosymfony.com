<?php

use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;
use Yosymfony\Spress\Core\Plugin\Event\ContentEvent;

class ThemeChangeLog implements PluginInterface
{
    private $io;
    private $statusLabel;
    private $statusLabelHtml;

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
        $subscriber->addEventListener('spress.before_convert', 'onBeforeConvert');

        $this->statusLabel = ['[New] ', '[Improved] ', '[Fixed] ', '[Deleted] ', '[Deprecated] '];
        $this->statusLabelHtml = [
            '<span class="label label-success">New</span> ',
            '<span class="label label-primary">Improved</span> ',
            '<span class="label label-default">Fixed</span> ',
            '<span class="label label-danger">Deleted</span> ',
            '<span class="label label-danger">Deprecated</span> ',
        ];
    }

    public function getMetas()
    {
        return [
            'name' => 'theme/changelog',
            'description' => 'Theme changelog support',
            'author' => 'Victor Puertas',
            'license' => 'MIT',
        ];
    }

    public function onStart(EnvironmentEvent $event)
    {
        $this->io = $event->getIO();
    }

    public function onBeforeConvert(ContentEvent $event)
    {
        $attributes = $event->getAttributes();

        if (isset($attributes['changelog_support']) === false || $attributes['changelog_support'] !== true) {
            return;
        }

        $content = $event->getContent();
        $content = str_replace($this->statusLabel, $this->statusLabelHtml, $content);
        $event->setContent($content);
    }
}
