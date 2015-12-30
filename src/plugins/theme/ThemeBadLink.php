<?php

use Symfony\Component\DomCrawler\Crawler;
use Yosymfony\Spress\Core\DataSource\ItemInterface;
use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;
use Yosymfony\Spress\Core\Plugin\Event\FinishEvent;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Support\StringWrapper;

class ThemeBadLink implements PluginInterface
{
    private $io;
    private $isCurlEnabled;

    public function initialize(EventSubscriber $subscriber)
    {
        $this->isCurlEnabled = function_exists('curl_version');

        $subscriber->addEventListener('spress.start', 'onStart');

        if ($this->isCurlEnabled === false) {
            return;
        }

        $subscriber->addEventListener('spress.finish', 'onFinish');
    }

    public function getMetas()
    {
        return [
            'name' => 'theme/badlink',
            'description' => 'Theme bad link detector',
            'author' => 'Victor Puertas',
            'license' => 'MIT',
        ];
    }

    public function onStart(EnvironmentEvent $event)
    {
        $this->io = $event->getIO();

        if ($this->isCurlEnabled === false) {
            $this->io->write('<error>This plugin requires Curl extension installed.</error>');

            return;
        }

        $this->io->write('Processing links from HTML items...');
    }

    public function onFinish(FinishEvent $event)
    {
        $items = $event->getItems();
        $links = [];

        foreach ($items as $item) {
            if ($this->isHtmlItem($item)) {
                $crawler = new Crawler($item->getContent());

                $crawler->filter('a')->each(function (Crawler $node, $i) use (&$links, $item) {
                    if (isset($links[$item->getId()]) === false) {
                        $links[$item->getId()] = [];
                    }

                    $href = $node->attr('href');

                    if (in_array($href, $links[$item->getId()]) === false) {
                        $links[$item->getId()][] = $node->attr('href');
                    }
                });
            }
        }

        $this->processLinks($links);
    }

    private function isHtmlItem(ItemInterface $item)
    {
        $path = $item->getPath(ItemInterface::SNAPSHOT_PATH_PERMALINK);

        if (empty($path) === true) {
            return false;
        }

        $info = new SplFileInfo($item->getPath(ItemInterface::SNAPSHOT_PATH_PERMALINK));

        return $info->getExtension() === 'html';
    }

    private function processLinks(array $links)
    {
        $badCounter = 0;

        foreach ($links as $id => $urls) {
            foreach ($urls as $url) {
                if ($this->processUrl($id, $url) === false) {
                    ++$badCounter;
                }
            }
        }

        if ($badCounter === 0) {
            $this->io->write(sprintf('No broken links detected!', $url));
        } else {
            $this->io->write(sprintf('<error>%s broken links detected</error>', $badCounter));
        }
    }

    private function processUrl($id, $url)
    {
        $documentRoot = __DIR__.'/../../../build';

        $str = new StringWrapper($url);

        if ($str->startWith('#')) {
            return true;
        }

        if ($str->startWith('/')) {
            $relativePath = parse_url($url, PHP_URL_PATH);

            if ($relativePath === false) {
                $this->io->write(sprintf(' * Bad link: "%s"', $url));

                return false;
            }

            if (file_exists($documentRoot.$relativePath) === false) {
                $this->io->write(sprintf(' * Resource not found "%s" at Id: "%s"', $url, $id));

                return false;
            }

            return true;
        }
    }

    private function urlExists($url)
    {
        if (($rc = curl_init($url)) === false) {
            return false;
        }

        curl_setopt($rc, CURLOPT_HEADER, false);
        curl_setopt($rc, CURLOPT_FAILONERROR, true);
        curl_setopt($rc, CURLOPT_NOBODY, true);
        curl_setopt($rc, CURLOPT_RETURNTRANSFER, false);

        $connectable = curl_exec($rc);

        curl_close($rc);

        return $connectable;
    }
}
