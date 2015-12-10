<?php


use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;
use Yosymfony\Spress\Core\Plugin\Event\ContentEvent;
use Yosymfony\Spress\Core\Plugin\Event\FinishEvent;
use Yosymfony\Spress\Core\Plugin\Event\RenderEvent;
use Yosymfony\Spress\Core\Support\ArrayWrapper;

class ThemeMenu implements PluginInterface
{
    private $pageMenus = [];
    private $items = [];
    private $isMenuReady = false;

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
        $subscriber->addEventListener('spress.before_convert', 'onBeforeConvert');
        $subscriber->addEventListener('spress.before_render_blocks', 'onBeforeRenderBlocks');
    }

    public function getMetas()
    {
        return [
            'name' => 'theme/menu',
            'description' => 'Theme menu',
            'author' => 'Victor Puertas',
            'license' => 'MIT',
        ];
    }

    public function onStart(EnvironmentEvent $event)
    {
        $configValues = $event->getConfigValues();
        $configValues['page_menus'] = &$this->pageMenus;

        $event->setConfigValues($configValues);
    }

    public function onBeforeConvert(ContentEvent $event)
    {
        $attributes = $event->getAttributes();

        if (isset($attributes['menu']) === false) {
            return;
        }

        if (isset($attributes['menu']['id']) === false) {
            return;
        }

        if (isset($attributes['menu']['title']) === false) {
            return;
        }

        $this->items[] = $event->getItem();
    }

    public function onBeforeRenderBlocks(RenderEvent $event)
    {
        if ($this->isMenuReady === true) {
            return;
        }

        foreach ($this->items as $item) {
            $attributes = $item->getAttributes();

            $idMenu = $attributes['menu']['id'];

            if (isset($this->pageMenus[$idMenu]) === false) {
                $this->pageMenus[$idMenu] = [];
            }

            $this->pageMenus[$idMenu][] = [
                'id' => $item->getId(),
                'url' => $attributes['url'],
                'title' => $attributes['menu']['title'],
                'order' => isset($attributes['menu']['order']) ? $attributes['menu']['order'] : 1000,
            ];
        }

        foreach ($this->pageMenus as $idMenu => $menu) {
            $this->pageMenus[$idMenu] = (new ArrayWrapper($menu))->sortBy(function($key, $value){
                return $value['order'];
            });
        }

        $this->isMenuReady = true;
    }
}
