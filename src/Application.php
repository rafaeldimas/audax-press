<?php

namespace Audax\AudaxPress;

use DI\Container;
use DI\ContainerBuilder;

/**
 * Class Application
 *
 * @package Audax\AudaxPress
 */
final class Application
{
    private $container;
    private $defaultConfig = false;

    public function init(array $config = [])
    {
        $settings = $this->parsedConfig($config);

        $container = $this->buildContainer($settings);

        $this->container($container);

        $this->handleServicesProviders();

        return $this;
    }

    /**
     * @param Container|null $container
     * @return Container
     */
    public function container(Container $container = null)
    {
        if (!is_null($container)) {
            $this->container = $container;
        }
        return $this->container;
    }

    private function parsedConfig(array $config)
    {
        return array_merge_recursive($this->getDefaultConfig(), $config);
    }

    private function getDefaultConfig()
    {
        return $this->defaultConfig ?: $this->defaultConfig = require_once __DIR__.'/config/default.php';
    }

    /**
     * @param array $settings
     * @return \DI\Container
     * @throws \Exception
     */
    private function buildContainer(array $settings)
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions($settings);
        $container = $containerBuilder->build();
        $container->set('app', $this);
        return $container;
    }

    private function handleServicesProviders()
    {
        (new HandleServiceProviders($this->container()->get('providers'), $this))
            ->fireServices()
            ->fireBoots();
    }
}
