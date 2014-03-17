<?php

namespace Yosymfony\Spress\Composer\Installer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;
use Symfony\Component\Yaml\Yaml;

class Installer extends LibraryInstaller
{
    const TYPE_PLUGIN = 'spress-plugin';
    const TYPE_THEME = 'spress-theme';
    
    const CONFIG_FILE = 'config.yml';
    const TEMPLATES_DIR_SPRESS_ROOT = 'app/templates';
    const TEMPLATES_DIR = 'yosymfony/spress-templates';
    const CONFIG_DIR = 'app/config';
    
    /**
    * {@inheritDoc}
    */
    public function getPackageBasePath(PackageInterface $package)
    {
        switch($package->getType())
        {
            case self::TYPE_PLUGIN:
                $dir = $this->getPluginsDir();
            break;
            
            case self::TYPE_THEME:
                $dir = $this->getThemeDir();
            break;
        }
        
        $name  = $this->getExtraName($package);
    
        return $dir . '/' . $name;
    }
    
    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return in_array($packageType, [
            self::TYPE_PLUGIN,
            self::TYPE_THEME
        ], true);
    }
    
    /**
     * {@inheritDoc}
     */
    public function isInstalled(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        if($this->isInstallFromSpressRoot() && self::TYPE_PLUGIN === $package->getType())
        {
            return true;   
        }
        
        return parent::isInstalled($repo, $package);
    }
    
    /**
     * {@inheritDoc}
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        if($this->isInstallFromSpressRoot() && self::TYPE_PLUGIN === $package->getType())
        {
            return;   
        }
        
        parent::install($repo, $package);
    }
    
    /**
     * {@inheritDoc}
     */
    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        if($this->isInstallFromSpressRoot() && self::TYPE_PLUGIN === $package->getType())
        {
            return;   
        }

        parent::update($repo, $initial, $package);
    }
    
    /**
     * {@inheritDoc}
     */
    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        if($this->isInstallFromSpressRoot() && self::TYPE_PLUGIN === $package->getType())
        {
            return;   
        }
        
        parent::uninstall($repo, $package);
    }
    
    /**
    * Get the theme/plugin name from the package extra info
    *
    * @param PackageInterface $package
    * @throws \InvalidArgumentException
    *
    * @return string
    */
    protected function getExtraName(PackageInterface $package)
    {
        $extraData = $package->getExtra();
        
        if (!array_key_exists('spress_name', $extraData)) {
            throw new \InvalidArgumentException(
                'Unable to install theme/plugin, Spress addons must '
                .'include the name in the extra field of composer.json.'
            );
        }
        
        return $extraData['spress_name'];
    }
    
    /**
     * Get the plugins folder from config.yml of the site
     * 
     * @return string Relative path to composer.json.
     */
    protected function getPluginsDir()
    {
        $config = $this->getConfigSite();
        $relativePath = isset($config['plugins']) ? $config['plugins'] : '_plugins';
        $relativePath = $this->prepareDir($relativePath);
        
        return $relativePath;
    }
    
    /**
     * Read the config.yml of the site
     * 
     * @return array
     */
    protected function getConfigSite()
    {
        if(!file_exists(self::CONFIG_FILE))
        {
            throw new \InvalidArgumentException(
                'Unable to install Spress plugin: config.yml file of the site '
                .'was not found.'
            );
        }
        
        return Yaml::parse(self::CONFIG_FILE);
    }
    
    /**
     * Get the theme dir
     * 
     * @return string Relative path to composer.json.
     */
    protected function getThemeDir()
    {
        $result = self::TEMPLATES_DIR_SPRESS_ROOT;
        
        if(false == $this->isInstallFromSpressRoot())
        {
            $result = sprintf('%s/%s', $this->vendorDir, self::TEMPLATES_DIR);
        }
        
        return $result;
    }
    
    /**
     * Exists the template dir at the Spress installation dir?
     * 
     * @return boolean
     */
    protected function existsConfigDir()
    {
        return file_exists(self::CONFIG_DIR);
    }
    
    /**
     * @param string $relativePath
     * 
     * @return string
     */
    protected function prepareDir($relativePath)
    {
        $result = str_replace(['.', '..'], '', $relativePath);
        $result = trim($result, '//');
        
        return $result;
    }
    
    /**
     * @return boolean
     */
    protected function isInstallFromSpressRoot()
    {
        return 'yosymfony/spress' === $this->composer->getPackage()->getName();
    }
}