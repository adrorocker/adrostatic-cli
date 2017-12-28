<?php

namespace AdroStatic\Cli\Command;

interface CommandInterface
{
    public static function factory(string $dir = null);
}
