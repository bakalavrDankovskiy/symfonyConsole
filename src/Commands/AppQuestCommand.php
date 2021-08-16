<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class AppQuestCommand extends Command
{
    protected static $defaultName = 'app:quest';
    protected $name;

    public static function output()
    {
        return 'im Alive';
    }

    protected function configure(): void
    {   //Description and help
        $this->setDescription('interactively greets you');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        /**
         * Запрос имени
         */
        $nameQuestion = new Question('Введите ваше имя:' . PHP_EOL . ">");
        $ageQuestion = new Question('Введите ваш возраст:' . PHP_EOL . ">");
        $sexQuestion = new ChoiceQuestion('Выберите пол:', ['М', 'Ж'], 0);

        do {
            $name = $this->formatString($helper->ask($input, $output, $nameQuestion));
            if (empty($name)) {
                $output->writeln('<error>Вы ввели пустую строку</error>');
            }
        } while (empty($name));

        do {
            $age = $this->formatString($helper->ask($input, $output, $ageQuestion));
            if (empty($age)) {
                $output->writeln('<error>Вы ввели пустую строку</error>');
            } elseif (!$this->validateAgeString($age)) {
                $output->writeln('<error>Вы ввели не число</error>');
            }
        } while (empty($age) || !$this->validateAgeString($age));

        $sex = $helper->ask($input, $output, $sexQuestion);
        $output->writeln(
            'Здравствуйте, ' . $name .
            ', Ваш возраст ' . $age .
            ', Ваш пол ' . $sex
        );
        return self::SUCCESS;
    }

    protected function formatString(string|null $string): string|null
    {
        return is_null($string) ? null : str_replace(['\'', "\"", ' '], '', $string);
    }

    protected function validateAgeString(string $string): bool
    {
        $result = (bool)preg_match('/^\d*$/', $string);
        return $result;
    }
}