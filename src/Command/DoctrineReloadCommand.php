<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

class DoctrineReloadCommand extends Command
{
    protected static $defaultName = 'doctrine:reload';

    private static $choices = [
        'No',
        'Yes',
    ];

    protected function configure(): void
    {
        $this->setDescription('Purge database, execute migrations and load fixtures');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');

        $question = new ChoiceQuestion('All data will be lost. Do you wish to continue?', self::$choices, false);

        if ($helper->ask($input, $output, $question) === self::$choices[1]) {
            $application = $this->getApplication();
            $application->setAutoExit(false);

            $io->writeln('Drop Database');
            $options = ['command' => 'doctrine:database:drop', '--force' => true];
            $application->run(new \Symfony\Component\Console\Input\ArrayInput($options));

            $io->writeln('Create Database');
            $options = ['command' => 'doctrine:database:create', '--if-not-exists' => true];
            $application->run(new \Symfony\Component\Console\Input\ArrayInput($options));

            $io->writeln('Executing Migrations');
            $options = ['command' => 'doctrine:migration:migrate', '--no-interaction' => true];
            $application->run(new \Symfony\Component\Console\Input\ArrayInput($options));

            $io->writeln('Load Fixtures');
            $options = ['command' => 'doctrine:fixtures:load', '--no-interaction' => true];
            $application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
        }
    }
}
