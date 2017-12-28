<?php

namespace AdroStatic\Cli\Helper;

use AdroStatic\Cli\Application;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class Fs
{
    use InstanceTrait;

    protected $fs = null;

    protected function __construct()
    {
        $here = Application::instance()->getHere();

        $this->fs = new Filesystem(new Local($here));
    }

    public function __call($name, $arguments)
    {
        return $this->fs->$name($arguments);
    }

    public function recurseCopy($src, $dst)
    {
        recurse_copy($src, $dst);

        return $this;
    }
}
