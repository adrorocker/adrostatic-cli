<?php

namespace AdroStatic\Cli\Helper;

use AdroStatic\Cli\Application;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class Skeleton
{
    use InstanceTrait;

    protected $path = '/adrostatic-skeleton';

    protected $vendor = '/vendor/adrorocker';

    public function getSkeletonPath()
    {
        $here = Application::instance()->getHere();

        return $here.$this->vendor.$this->path;
    }
}
