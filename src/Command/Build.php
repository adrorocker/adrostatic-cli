<?php

namespace AdroStatic\Cli\Command;

use AdroStatic\AdroStatic;
use AdroStatic\Cli\Application;
use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Build extends Command
{
    protected function configure()
    {
        $this->setName('build')
            ->setDescription('Build the static site.')
            ->setHelp('This command allows you to build all the static files for yout site.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $root = Application::instance()->getDir();
        AdroStatic::factory($root)->build();
    }
}
