<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Commands\HelloCommand;

$application = new Application();
$application->add(new HelloCommand());
$application->run();