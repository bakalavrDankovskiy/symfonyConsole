<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Commands\AppQuestCommand;
use Commands\SayStringCommand;
use Commands\HelloCommand;

$application = new Application();
$application->add(new HelloCommand());
$application->add(new SayStringCommand());
$application->add(new AppQuestCommand());
$application->run();