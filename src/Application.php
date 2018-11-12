<?php

namespace GrupoAudax\AudaxPress;

use GrupoAudax\AudaxPress\Support\Config;
use GrupoAudax\AudaxPress\Contract\Config as ConfigContract;
use DirectoryIterator;
use Illuminate\Container\Container;
use RegexIterator;

/**
 * Class Application
 *
 * @package GrupoAudax\AudaxPress
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
     * @throws \ReflectionException
     */
    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->registerBaseBindings();

        $this->registerConfigBindings();

        $this->registerServiceProviders();
    }

    /**
     *
     */
    protected function registerBaseBindings(): void
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->instance(Container::class, $this);
    }

    /**
     *
     */
    protected function registerConfigBindings() : void
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
    protected function configFilesName(): array
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

    /**
     * @param array $configs
     * @return array
     */
    protected function mergeDefaultsConfigFilesName(array $configs): array
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
    private function registerServiceProviders(): void
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
    protected function bindPathsInContainer(): void
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
    public function path($path = ''): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'app'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function basePath($path = ''): string
    {
        return $this->basePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function configPath($path = ''): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'config'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function publicPath($path = ''): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'public'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function bootstrapPath($path = ''): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'bootstrap'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
