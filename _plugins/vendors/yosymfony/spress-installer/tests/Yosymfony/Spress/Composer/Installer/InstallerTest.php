<?php

namespace Yosymfony\Spress\Composer\Installer;

require __DIR__ . '/../../../../../vendor/composer/composer/tests/Composer/TestCase.php';

use Composer\Util\Filesystem;
use Composer\TestCase;
use Composer\Composer;
use Composer\Config;
use Composer\Package\RootPackage;
use Composer\Downloader\DownloadManager;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\IO\IOInterface;
use \Mockery as m;

class InstallerTest extends TestCase
{

    /** @var Composer $composer */
    protected $composer;
    
    /** @var Config $config */
    protected $config;
    
    /** @var string $vendorDir */
    protected $vendorDir;
    
    /** @var string $binDir */
    protected $binDir;
    
    /** @var string $spressDir */
    protected $spressDir;
    
    /** @var string $spressTemplateDir */
    protected $spressTemplateDir;
    
    /** @var DownloadManager $downloadManager */
    protected $downloadManager;
    
    /** @var InstalledRepositoryInterface $repository */
    protected $repository;
    
    /** @var IOInterface $io */
    protected $io;
    
    /** @var Filesystem $filesystem */
    protected $filesystem;
    
    /** @var RootPackage $package */
    protected $package;
    
    protected function setUp()
    {
        $this->filesystem = new Filesystem;
    
        $this->composer = new Composer();
        $this->config = new Config();
        $this->composer->setConfig($this->config);
        
        $this->package = new RootPackage('yosymfony/spress', '1.0.0', '1.0.0');
        $this->composer->setPackage($this->package);
    
        $this->vendorDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR
            .'composer-test-vendor';
        $this->ensureDirectoryExistsAndClear($this->vendorDir);
    
        $this->binDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR
            .'composer-test-bin';
        $this->ensureDirectoryExistsAndClear($this->binDir);
        
        $this->spressDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR
            .'spress-test';
        $this->ensureDirectoryExistsAndClear($this->spressDir);
        
        $this->spressTemplateDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR
            .'spress-test/app/config';
        $this->ensureDirectoryExistsAndClear($this->spressTemplateDir);
    
        $this->config->merge(
            array(
                'config' => array(
                    'vendor-dir' => $this->vendorDir,
                    'bin-dir'    => $this->binDir,
                ),
            )
        );
    
        $this->downloadManager = m::mock('Composer\Downloader\DownloadManager');
        $this->composer->setDownloadManager($this->downloadManager);
    
        $this->repository = m::mock('Composer\Repository\InstalledRepositoryInterface');
        $this->io = m::mock('Composer\IO\IOInterface');
        
        
    }
    
    protected function tearDown()
    {
        $this->filesystem->removeDirectory($this->vendorDir);
        $this->filesystem->removeDirectory($this->binDir);
        $this->filesystem->removeDirectory($this->spressDir);
    }
    
    public function testGetInstallPathForThemes()
    {
        $package = new RootPackage('yosymfony/not-spress', '1.0.0', '1.0.0');
        $composer = $this->createComposerMock();
        $composer->setPackage($package);
        
        $library = new Installer($this->io, $composer);
        
        $package = $this->createThemePackageMock('Test');
    
        $this->assertEquals(
            $this->vendorDir.'/yosymfony/spress-templates/Test',
            $library->getInstallPath($package)
        );
    }
    
    public function testGetInstallPathForThemesSpressRoot()
    {
        chdir($this->spressDir);
        
        $library = new Installer($this->io, $this->composer);
        $package = $this->createThemePackageMock('Test');
    
        $this->assertEquals(
            'app/templates/Test',
            $library->getInstallPath($package)
        );
    }
    
    public function testGetInstallPathForPlugins()
    {
        chdir('./tests/fixtures/spress-site');
        
        $library = new Installer($this->io, $this->composer);
        $package = $this->createPluginPackageMock('Test');
    
        $this->assertEquals(
            '_plugins/Test',
            $library->getInstallPath($package)
        );
    }
    
    public function testGetInstallPathForPluginsFolderChanged()
    {
        chdir('./tests/fixtures/spress-site-2');
        
        $library = new Installer($this->io, $this->composer);
        $package = $this->createPluginPackageMock('Test');
    
        $this->assertEquals(
            '_plugins2/Test',
            $library->getInstallPath($package)
        );
    }
    
    public function testGetInstallPathWithoutName()
    {
        $this->setExpectedException('InvalidArgumentException');
        $library = new Installer($this->io, $this->composer);
        $package = $this->createPluginPackageMock();
    
        $library->getInstallPath($package);
    }
    
    public function testSupports()
    {
        $library = new Installer($this->io, $this->composer);
    
        $this->assertTrue($library->supports('spress-theme'));
        $this->assertTrue($library->supports('spress-plugin'));
        $this->assertFalse($library->supports('library'));
    }
    
    protected function createPackageMock($spressName = null)
    {
        $package = m::mock('Composer\Package\Package', array(md5(rand()), '1.0.0.0', '1.0.0'));
    
        $extra = array();
        if (!is_null($spressName)) {
            $extra = array(
                'spress_name' => $spressName
            );
        }
    
        $package->shouldReceive('getExtra')->andReturn($extra);
        $package->shouldReceive('getTargetDir')->andReturn('');
        $package->shouldReceive('getPrettyName')->andReturn($spressName);
    
        return $package;
    }
    
    protected function createThemePackageMock($spressName = null)
    {
        $package = $this->createPackageMock($spressName);
        $package->shouldReceive('getType')->andReturn('spress-theme');
    
        return $package;
    }
    
    protected function createPluginPackageMock($spressName = null)
    {
        $package = $this->createPackageMock($spressName);
        $package->shouldReceive('getType')->andReturn('spress-plugin');
    
        return $package;
    }
    
    protected function createComposerMock()
    {
        $composer = new Composer();
        $composer->setConfig($this->config);
        $composer->setDownloadManager($this->downloadManager);
    
        return $composer;
    }
}