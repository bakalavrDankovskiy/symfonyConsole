<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Commands\AppQuestCommand;

$application = new Application();
$application->add(new AppQuestCommand());
$application->run();