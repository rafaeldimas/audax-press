<?php

namespace Audax\AudaxPress;

use Audax\AudaxPress\Support\Config;
use Audax\AudaxPress\Contract\Config as ConfigContract;
use DirectoryIterator;
use Illuminate\Container\Container;
use RegexIterator;

/**
 * Class Application
 *
 * @package Audax\AudaxPress
 */
final class Application extends Container
{
    protected $basePath = '';

    protected $configPath = '';

    protected $publicPath = '';

    protected $themesPath = '';

    protected $bootstrapPath = '';

    /**
     * Application constructor.
     *
     * @param null $basePath
     */
    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->registerBaseBindings();

        $this->registerConfigBindings();

        $this->registerServiceProviders();

        return $this;
    }

    /**
     *
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->instance(Container::class, $this);
    }

    /**
     *
     */
    protected function registerConfigBindings()
    {
        $configs = $this->configFilesName();

        $configInstance = new Config($configs);

        $this->instance('config', $configInstance);
        $this->instance(Config::class, $configInstance);
        $this->instance(ConfigContract::class, $configInstance);
    }

    /**
     * @return array
     */
    protected function configFilesName()
    {
        $configFilesName = [];
        $configsIterator = new RegexIterator(new DirectoryIterator($this->configPath()), "/\\.php\$/i");

        /** @var DirectoryIterator $configFile */
        foreach ($configsIterator as $configFile) {
            $fileFullName = $this->configPath().DIRECTORY_SEPARATOR.$configFile->getFilename();
            $configFilesName[$configFile->getBasename('.php')] = require_once $fileFullName;
        }

        $configFilesName = $this->mergeDefaultsConfigFilesName($configFilesName);

        return $configFilesName;
    }

    protected function mergeDefaultsConfigFilesName(array $configs)
    {
        $configDir = __DIR__.'/config';
        $configFilesName = [];
        $configsIterator = new RegexIterator(new DirectoryIterator($configDir), "/\\.php\$/i");

        /** @var DirectoryIterator $configFile */
        foreach ($configsIterator as $configFile) {
            $fileFullName = $configDir.DIRECTORY_SEPARATOR.$configFile->getFilename();
            $configFilesName[$configFile->getBasename('.php')] = require_once $fileFullName;
        }

        return array_merge_recursive($configFilesName, $configs);
    }

    /**
     * @throws \ReflectionException
     */
    private function registerServiceProviders()
    {
        $handleServiceProviders = new HandleServiceProviders();
        $handleServiceProviders
            ->setApp($this)
            ->setServiceProviders($this->get('config')->get('app.providers'))
            ->fire();
    }

    /**
     * @param string $basePath
     */
    protected function setBasePath(string $basePath): void
    {
        $this->basePath = rtrim($basePath, '\/');

        $this->bindPathsInContainer();
    }

    /**
     *
     */
    protected function bindPathsInContainer()
    {
        $this->instance('path', $this->path());
        $this->instance('path.base', $this->basePath());
        $this->instance('path.config', $this->configPath());
        $this->instance('path.public', $this->publicPath());
        $this->instance('path.bootstrap', $this->bootstrapPath());
    }

    /**
     * @param string $path
     * @return string
     */
    public function path($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'app'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function basePath($path = '')
    {
        return $this->basePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function configPath($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'config'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function publicPath($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'public'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function bootstrapPath($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'bootstrap'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
