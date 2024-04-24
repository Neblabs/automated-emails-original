<?php

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\App\Creators\Component\ComponentFileCreator;
use AutomatedEmails\App\Creators\ComponentsProviderInterface\ComponentsProviderInterfaceFileCreator;
use AutomatedEmails\App\Creators\Components\ComponentsRegistratorFileCreator;
use AutomatedEmails\App\Tasks\Creators\ComponentCommandCreatorTask;
use AutomatedEmails\Original\Characters\Suffixed;
use AutomatedEmails\Original\Creators\Command\CommandFileCreator;
use AutomatedEmails\Original\Creators\Command\CommandRegistratorTask;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

Class ComponentsCreatorCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.component');
        $this->setDescription('Creates and registers a new Type of component, not an individual component, but a whole category.');

        $this->addArgument('componentNameNoSuffix', InputArgument::REQUIRED);
        //$this->addOption('app', null, InputOption::VALUE_NONE, 'the very useful description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $componentsRegistratorName = new Suffixed(
            text: $input->getArgument('componentNameNoSuffix'),
            suffix: 'ComponentsRegistrator'
        );

        (object) $componentsName = new Suffixed(
            text: $input->getArgument('componentNameNoSuffix'),
            suffix: 'Components'
        );

        (object) $componentsProviderInterfaceFileCreator = new ComponentsProviderInterfaceFileCreator(
            $componentsName  
        );

        (object) $componentFilesCreator = new ComponentsRegistratorFileCreator(
            componentsRegistratorName: $componentsRegistratorName,
            componentsProviderInterfaceName: $componentsName
        );

        (object) $commandFileCreator = new CommandFileCreator(
            commandNameNoSuffix: "{$componentsName->withoutSuffix()}Creator",
            createInAppDirectory: true,
            templateFile: 'app/creators/component/ComponentCommandCreatorTemplate.php',
            dataToPassToTemplate: _(
                componentNameWithSuffix: $componentsName->withSuffix(),
                componentNameWithoutSuffix: $componentsName->withoutSuffix(),
                commandName: $componentsName->withoutSuffix()->toLowerCase()
            )
        );

        $commandFileCreator->registerCompletionTasks([
            new CommandRegistratorTask
        ]);

        $componentsProviderInterfaceFileCreator->create();
        $componentFilesCreator->create();
        $commandFileCreator->create();

        return 1;
    }
}