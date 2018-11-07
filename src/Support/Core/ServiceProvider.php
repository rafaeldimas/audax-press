<?php

namespace Radial\Support\Core;

abstract class ServiceProvider
{
    public abstract function boot();

    protected function registerTranslation($alias, $path)
    {
        load_theme_textdomain($alias, $path);
    }

    protected function registerHelperFunction($file)
    {
        if (!file_exists($file)) {
            throw new \Exception("File not Found: {$file}");
        }

        require_once $file;
    }

    protected function registerNavMenu($slug, $name)
    {
        register_nav_menus(array($slug => $name));
    }

    protected function registerThemeSupport($feature, $config = array())
    {
        add_theme_support($feature, $config);
    }

    protected function registerFilter($tag, $callback, $priority = 10)
    {
        add_filter( $tag, $callback, $priority);
    }

    protected function unregisterFilter($tag, $callback, $priority = 1)
    {
        remove_filter($tag, $callback, $priority);
    }

    protected function registerAction($tag, $callback, $priority = 10, $accepted_args = 1)
    {
        add_action($tag, $callback, $priority, $accepted_args);
    }

    protected function unregisterAction($tag, $callback, $priority = 1)
    {
        remove_action($tag, $callback, $priority);
    }

    protected function unregisterActions(array $actions)
    {
        foreach ($actions as $tag => $callback) {
            if (!is_array($callback)) {
                $this->unregisterAction($tag, $callback);
                continue;
            }

            foreach ($callback as $item) {
                $this->unregisterAction($tag, $item);
            }
        }
    }
}
