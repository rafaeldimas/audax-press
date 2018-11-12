<?php

namespace GrupoAudax\AudaxPress;

use GrupoAudax\AudaxPress\Contract\ServiceProvider;
use Illuminate\Container\Container;
use InvalidArgumentException;
use ReflectionClass;

class HandleServiceProviders
{
    /**
     * @var Container
     */
    private $app;

    private $serviceProviders = [];

    private $serviceProvidersInstance = [];

    /**
     * @throws \ReflectionException
     */
    public function fire()
    {
        foreach ($this->serviceProviders as $provider) {
            $this->register($provider);
        }
    }

    /**
     * @param $provider
     * @param bool $force
     * @return array|ServiceProvider
     * @throws \ReflectionException
     */
    public function register($provider, $force = false)
    {
        if (($registered = $this->getProviderInstance($provider)) && ! $force) {
            return $registered;
        }

        if (is_string($provider)) {
            $provider = $this->resolveProvider($provider);
        }

        $this->fireRegisters($provider);

        $this->fireBindingsProperty($provider);

        $this->fireSingletonsProperty($provider);

        $this->fireBoots($provider);

        return $provider;
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function getProviderInstance($provider)
    {
        $name = is_string($provider) ? $provider : get_class($provider);

        return array_reduce($this->serviceProvidersInstance, function ($provider, $providerCurrent) use ($name) {
            if ($provider) return $provider;
            if ($providerCurrent instanceof  $name) {
                return $providerCurrent;
            }
            return false;
        }, false);
    }

    /**
     * @param $provider
     * @return ServiceProvider
     * @throws \ReflectionException
     */
    private function resolveProvider($provider)
    {
        if (!class_exists($provider)) {
            throw new InvalidArgumentException("Service Provider {$provider} not found");
        }
        if (!(new ReflectionClass($provider))->implementsInterface(ServiceProvider::class)) {
            throw new InvalidArgumentException(
                sprintf('Service Provider %s not implements %s}', $provider, ServiceProvider::class)
            );
        }
        return new $provider($this->app);
    }

    protected function fireRegisters(ServiceProvider $provider)
    {
        if (method_exists($provider, 'register')) {
            $provider->register();
        }
        return $this;
    }

    protected function fireBindingsProperty(ServiceProvider $provider)
    {
        if (property_exists($provider, 'bindings')) {
            foreach ($provider->bindings as $key => $value) {
                $this->app->bind($key, $value);
            }
        }
    }

    protected function fireSingletonsProperty(ServiceProvider $provider)
    {
        if (property_exists($provider, 'singletons')) {
            foreach ($provider->singletons as $key => $value) {
                $this->app->singleton($key, $value);
            }
        }
    }

    protected function fireBoots(ServiceProvider $provider)
    {
        if (method_exists($provider, 'boot')) {
            $this->app->call([$provider, 'boot']);
        }
        return $this;
    }

    /**
     * @param Container $app
     * @return HandleServiceProviders
     */
    public function setApp(Container $app): HandleServiceProviders
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @param array $serviceProviders
     * @return HandleServiceProviders
     */
    public function setServiceProviders(array $serviceProviders): HandleServiceProviders
    {
        $this->serviceProviders = $serviceProviders;
        return $this;
    }
}
