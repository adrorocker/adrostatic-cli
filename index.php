#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use AdroStatic\Cli\Application;

$application = new Application(getcwd());

$application->run();