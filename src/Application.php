<?php

namespace GrupoAudax\AudaxPress;

use GrupoAudax\AudaxPress\Contract\Support\Path as PathContract;
use GrupoAudax\AudaxPress\Support\Config;
use GrupoAudax\AudaxPress\Contract\Support\Config as ConfigContract;
use DirectoryIterator;
use GrupoAudax\AudaxPress\Support\Path;
use Illuminate\Container\Container;
use RegexIterator;

/**
 * Class Application
 *
 * @package GrupoAudax\AudaxPress
 */
final class Application extends Container
{
    /**
     * Application constructor.
     *
     * @param string|null $basePath
     * @throws \ReflectionException
     */
    public function __construct($basePath = null)
    {
        $this->registerBasePathBindings($basePath);

        $this->registerBaseBindings();

        $this->registerConfigBindings();

        $this->registerServiceProviders();
    }

    public function registerBasePathBindings($basePath)
    {
        $path = new Path();

        $this->instance('path', $path);
        $this->instance(Path::class, $path);
        $this->instance(PathContract::class, $path);

        if ($basePath) $path->setBasePath($basePath);
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
        $configDir = $this->configPath().DIRECTORY_SEPARATOR;
        $configFilesName = [];
        $configsIterator = new RegexIterator(new DirectoryIterator($this->configPath()), "/\\.php\$/i");

        /** @var DirectoryIterator $configFile */
        foreach ($configsIterator as $configFile) {
            $fileFullName = $configDir.$configFile->getFilename();
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
        $configDir = __DIR__.DIRECTORY_SEPARATOR.'config';
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
     * @param string $path
     * @return string
     */
    public function appPath($path = ''): string
    {
        return $this->get('path')->appPath($path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function basePath($path = ''): string
    {
        return $this->get('path')->basePath($path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function configPath($path = ''): string
    {
        return $this->get('path')->configPath($path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function publicPath($path = ''): string
    {
        return $this->get('path')->publicPath($path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function bootstrapPath($path = ''): string
    {
        return $this->get('path')->bootstrapPath($path);
    }
}
