<?php

namespace AdroStatic\Cli\Command;

use Symfony\Component\Console\Command\Command as ConsoleCommand;

class Command extends ConsoleCommand
{
    protected $dir;

    public function __construct(string $dir = null, string $name = null)
    {
        $this->dir = $dir;
        parent::__construct($name);
    }

    public function getDir()
    {
        return $this->dir;
    }

    public static function factory(string $dir = null, string $name = null)
    {
        return new static($dir, $name);
    }
}
