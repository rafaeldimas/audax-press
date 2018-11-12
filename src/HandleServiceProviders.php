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

    /**
     * @var string[]
     */
    private $serviceProviders = [];

    /**
     * @var ServiceProvider[]
     */
    private $serviceProvidersInstance = [];

    /**
     * @throws \ReflectionException
     */
    public function fire(): void
    {
        foreach ($this->serviceProviders as $provider) {
            $this->register($provider);
        }
    }

    /**
     * @param $provider
     * @param bool $force
     * @return ServiceProvider
     * @throws \ReflectionException
     */
    public function register($provider, $force = false): ServiceProvider
    {
        if (($registered = $this->getProviderInstance($provider)) && !$force) {
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
     * @return ServiceProvider|null
     */
    public function getProviderInstance($provider): ?ServiceProvider
    {
        $name = is_string($provider) ? $provider : get_class($provider);

        return array_reduce($this->serviceProvidersInstance, function ($provider, $providerCurrent) use ($name) {
            if ($provider) return $provider;
            if ($providerCurrent instanceof  $name) {
                return $providerCurrent;
            }
            return null;
        }, null);
    }

    /**
     * @param string|object $provider
     * @return ServiceProvider
     * @throws \ReflectionException
     */
    private function resolveProvider($provider): ServiceProvider
    {
        $provider = is_string($provider) ? $provider : get_class($provider);

        if (!class_exists($provider)) {
            throw new InvalidArgumentException("Service Provider {$provider} not found");
        }
        if (!(new ReflectionClass($provider))->implementsInterface(ServiceProvider::class)) {
            throw new InvalidArgumentException(
                sprintf('Service Provider %s not implements %s}', $provider, ServiceProvider::class)
            );
        }

        $providerInstance = new $provider($this->app);
        $this->serviceProvidersInstance[] = $providerInstance;

        return $providerInstance;
    }

    /**
     * @param ServiceProvider $provider
     * @return HandleServiceProviders
     */
    protected function fireRegisters(ServiceProvider $provider): HandleServiceProviders
    {
        if (method_exists($provider, 'register')) {
            $provider->register();
        }
        return $this;
    }

    /**
     * @param ServiceProvider $provider
     * @return HandleServiceProviders
     */
    protected function fireBindingsProperty(ServiceProvider $provider): HandleServiceProviders
    {
        if (property_exists($provider, 'bindings')) {
            foreach ($provider->bindings as $key => $value) {
                $this->app->bind($key, $value);
            }
        }
        return $this;
    }

    /**
     * @param ServiceProvider $provider
     * @return HandleServiceProviders
     */
    protected function fireSingletonsProperty(ServiceProvider $provider): HandleServiceProviders
    {
        if (property_exists($provider, 'singletons')) {
            foreach ($provider->singletons as $key => $value) {
                $this->app->singleton($key, $value);
            }
        }
        return $this;
    }

    /**
     * @param ServiceProvider $provider
     * @return HandleServiceProviders
     */
    protected function fireBoots(ServiceProvider $provider): HandleServiceProviders
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
     * @param string[] $serviceProviders
     * @return HandleServiceProviders
     */
    public function setServiceProviders(array $serviceProviders): HandleServiceProviders
    {
        $this->serviceProviders = $serviceProviders;
        return $this;
    }
}
