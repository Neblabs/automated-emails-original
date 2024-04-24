<?php declare(strict_types=1);

namespace AutomatedEmails\Original\Commands\BuiltIn;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Creators\SystemFilesCreator;
use AutomatedEmails\Original\Creators\Test\TestFileCreator;
use AutomatedEmails\Original\Environment\Env;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class TestCreatorCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.test');
        $this->setDescription('Create a test file inside the tests/unit directory. You just have to give it the absolute path of a file inside the plugin directory.');

        $this->addArgument('absoluteFilePath', InputArgument::REQUIRED, '');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $testFileCreator = new TestFileCreator(
            absoluteFilePath: $input->getArgument('absoluteFilePath'),
            taskData: _(),
            testGroup: null,
        );

        $testFileCreator->create();

        return 1;
    }
}   