<?php

namespace AdroStatic\Cli\Helper;

trait InstanceTrait
{
    protected static $instance = null;

    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }
        return static::$instance;
    }
}
