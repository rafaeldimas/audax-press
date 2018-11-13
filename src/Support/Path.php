<?php

namespace GrupoAudax\AudaxPress\Support;


class Path
{

    const DEFAULT_FOLDER_APP = 'app';
    const DEFAULT_FOLDER_CONFIG = 'config';
    const DEFAULT_FOLDER_PUBLIC = 'public';
    const DEFAULT_FOLDER_THEMES = 'app'.DIRECTORY_SEPARATOR.'themes';
    const DEFAULT_FOLDER_BOOTSTRAP= 'bootstrap';

    /**
     * @var string
     */
    protected $basePath = '';

    /**
     * @var string
     */
    protected $appFolder = '';

    /**
     * @var string
     */
    protected $configFolder = '';

    /**
     * @var string
     */
    protected $publicFolder = '';

    /**
     * @var string
     */
    protected $themesFolder = '';

    /**
     * @var string
     */
    protected $bootstrapFolder = '';

    /**
     * @param string $basePath
     * @return $this
     */
    public function setBasePath(string $basePath): Path
    {
        $this->basePath = rtrim($basePath, '\/');
        return $this;
    }

    /**
     * @param string $appFolder
     * @return $this
     */
    public function setAppFolder(string $appFolder): Path
    {
        $this->appFolder = $appFolder;
        return $this;
    }

    /**
     * @param string $configFolder
     * @return $this
     */
    public function setConfigFolder(string $configFolder): Path
    {
        $this->configFolder = $configFolder;
        return $this;
    }

    /**
     * @param string $publicFolder
     * @return $this
     */
    public function setPublicFolder(string $publicFolder): Path
    {
        $this->publicFolder = $publicFolder;
        return $this;
    }

    /**
     * @param string $themesFolder
     * @return $this
     */
    public function setThemesFolder(string $themesFolder): Path
    {
        $this->themesFolder = $themesFolder;
        return $this;
    }

    /**
     * @param string $bootstrapFolder
     * @return $this
     */
    public function setBootstrapFolder(string $bootstrapFolder): Path
    {
        $this->bootstrapFolder = $bootstrapFolder;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppFolder(): string
    {
        return $this->appFolder ?: self::DEFAULT_FOLDER_APP;
    }

    /**
     * @return string
     */
    public function getConfigFolder(): string
    {
        return $this->configFolder ?: self::DEFAULT_FOLDER_CONFIG;
    }

    /**
     * @return string
     */
    public function getPublicFolder(): string
    {
        return $this->publicFolder ?: self::DEFAULT_FOLDER_PUBLIC;
    }

    /**
     * @return string
     */
    public function getThemesFolder(): string
    {
        return $this->themesFolder ?: self::DEFAULT_FOLDER_THEMES;
    }

    /**
     * @return string
     */
    public function getBootstrapFolder(): string
    {
        return $this->bootstrapFolder ?: self::DEFAULT_FOLDER_BOOTSTRAP;
    }

    /**
     * @param string $folder
     * @param string $path
     * @return string
     */
    private function parserPath(string $folder = '', string $path = '')
    {
        if (!$this->basePath) return '';
        return $this->basePath.($folder ? DIRECTORY_SEPARATOR.$folder : $folder).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function basePath($path = ''): string
    {
        return $this->parserPath('', $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function appPath($path = ''): string
    {
        return $this->parserPath($this->getAppFolder(), $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function configPath($path = ''): string
    {
        return $this->parserPath($this->getConfigFolder(), $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function publicPath($path = ''): string
    {
        return $this->parserPath($this->getPublicFolder(), $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function themesPath($path = ''): string
    {
        return $this->parserPath($this->getThemesFolder(), $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function bootstrapPath($path = ''): string
    {
        return $this->parserPath($this->getBootstrapFolder(), $path);
    }
}
