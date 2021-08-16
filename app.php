<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Commands\SayStringCommand;

$application = new Application();
$application->add(new SayStringCommand());
$application->run();