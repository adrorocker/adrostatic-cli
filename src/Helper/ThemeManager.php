<?php

namespace AdroStatic\Cli\Helper;

use AdroStatic\Cli\Application;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class ThemeManager
{
    use InstanceTrait;

    protected $path = '/adrostatic-themes';

    protected $vendor = '/vendor/adrorocker';
    
    protected $fs = null;

    protected function __construct()
    {
        $here = Application::instance()->getHere();

        $path = $here.$this->vendor.$this->path;

        $this->fs = new Filesystem(new Local($path));
    }

    public function getAvailableThemes()
    {
        $dirs = $this->fs->listContents();
        $themes = [];
        foreach ($dirs as $dir) {
            if ('dir' !== $dir['type'] || '.git' === $dir['path']) {
                continue;
            }
            $themes[] = $dir['path'];
        }

        return $themes;
    }

    public function getStarterTheme()
    {
        $here = Application::instance()->getHere();
        return $here.$this->vendor.$this->path.'/starter';
    }

    public function getThemesPath()
    {
        return Application::instance()->getDir().'/themes';
    }
}
