<?php

namespace AdroStatic\Cli;

use AdroStatic\AdroStatic;
use Phar;
use Symfony\Component\Console\Application as Console;

class Application extends Console
{
    const VERSION = '0.1.1';

    const NAME = <<<EOL
  ___      _           _____ _        _   _      _____ _ _ 
 / _ \    | |         /  ___| |      | | (_)    /  __ \ (_)
/ /_\ \ __| |_ __ ___ \ `--.| |_ __ _| |_ _  ___| /  \/ |_ 
|  _  |/ _` | '__/ _ \ `--. \ __/ _` | __| |/ __| |   | | |
| | | | (_| | | | (_) /\__/ / || (_| | |_| | (__| \__/\ | |
\_| |_/\__,_|_|  \___/\____/ \__\__,_|\__|_|\___|\____/_|_|
                                                           
                                               
\n VERSION: 
EOL;

    protected $here;
    
    protected $dir;

    protected static $instance;

    /**
     * @param string $name    The name of the application
     * @param string $version The version of the application
     */
    public function __construct($dir)
    {
        $this->here = dirname(__DIR__);
        if (!empty(Phar::running())) {
            $this->here = Phar::running();
        }
        $this->dir = $dir;
        parent::__construct(self::NAME, self::VERSION);

        $this->registerCommands();

        static::$instance = $this;
    }

    public static function instance()
    {
        return static::$instance;
    }

    protected function registerCommands()
    {
        $this->add(Command\Create::factory($this->dir));
        $this->add(Command\Build::factory($this->dir));
    }

    public function getDir()
    {
        return $this->dir;
    }

    public function getHere()
    {
        return $this->here;
    }
}
