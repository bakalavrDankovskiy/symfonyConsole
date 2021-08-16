<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SayStringCommand extends Command
{
    protected static $defaultName = 'say_hello ';

    public static function output()
    {
        return 'im Alive';
    }

    protected function configure(): void
    {   //Description and help
        $this->setDescription('outputs the string');

        //Required input parameter
        $this->addArgument
        (
            'objectForOutput',
            InputArgument::IS_ARRAY,
            'Object for output'
        );

        //Not required input option times
        $this->addOption
        (
            'times',
            't',
            InputOption::VALUE_OPTIONAL,
            'times for output',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $objectForOutput = $this->strFormatter(implode($input->getArgument('objectForOutput')));
            $option = $input->getOption('times');
            if (empty($objectForOutput)) {
                throw new InvalidArgumentException();
            }
            for ($i = 0; $i < $option; $i++) {
                $output->writeln($objectForOutput);
            }
        } catch (InvalidArgumentException $e) {
            $output->writeln('Вы ввели пустую строку, попробуйте еще раз',);
        }
        return self::SUCCESS;
    }

    protected function strFormatter(string|null $string): string|null
    {
        return is_null($string) ? null : trim(trim($string, '\''));
    }
}

