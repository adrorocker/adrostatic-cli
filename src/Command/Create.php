<?php

namespace AdroStatic\Cli\Command;

use AdroStatic\Cli\Application;
use AdroStatic\Cli\Helper\Fs;
use AdroStatic\Cli\Helper\ThemeManager;
use AdroStatic\Cli\Helper\Skeleton;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use ZipArchive;

class Create extends Command
{
    protected function configure()
    {
        $this->setName('create')
            ->setDescription('Creates a new site.')
            ->setHelp('This command allows you to create a new skeleton.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $themes = ThemeManager::instance()->getAvailableThemes();
        $themesPath = ThemeManager::instance()->getThemesPath();
        $starter = ThemeManager::instance()->getStarterTheme();
        $skeletonPath = Skeleton::instance()->getSkeletonPath();
        $dest = Application::instance()->getDir();
        try {
            Fs::instance()->recurseCopy($skeletonPath, $dest);
            Fs::instance()->recurseCopy($starter, $themesPath.'/starter');
        } catch (Exception $e) {
            return;
        }
        $process = new Process('which composer');
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            return;
        }

        $composer = trim($process->getOutput());


        $process = new Process("cd $dest && $composer install --no-dev");
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            return;
        }
    }
}
