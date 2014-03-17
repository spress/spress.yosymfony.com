<?php

namespace Yosymfony\Spress\Composer;

use Composer\Plugin\PluginInterface;
use Composer\Composer;
use Composer\IO\IOInterface;
use Yosymfony\Spress\Composer\Installer\Installer;

class SpressPlugin implements PluginInterface
{
    /**
    * Apply plugin modifications to composer
    *
    * @param Composer $composer
    * @param IOInterface $io
    */
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}