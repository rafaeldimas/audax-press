<?php

namespace Audax\AudaxPress;

class HandleServiceProviders
{
    private $app;
    private $providers = [];
    private $providersInstances = [];

    public function __construct(array $providers = [], Application $app)
    {
        $this->app = $app;
        $this->providers = $providers;
        $this->makeInstances();
    }

    public function fireBoots()
    {
        foreach ($this->providersInstances as $provider) {
            $provider->boot();
        }
        return $this;
    }

    public function fireServices()
    {
        foreach ($this->providersInstances as $provider) {
            $provider->service();
        }
        return $this;
    }

    private function makeInstances()
    {
        $providersInstances = [];
        foreach ($this->providers as $provider) {
            $providersInstances[] = $this->makeInstance($provider);
        }
        $this->providersInstances = $providersInstances;
    }

    private function makeInstance($className)
    {
        if (!class_exists($className)) {
            throw new InvalidArgumentException("Service Provider {$className} not found");
        }
        return new $className($this->app);
    }
}
