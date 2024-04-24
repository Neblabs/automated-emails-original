<?php

namespace AutomatedEmails\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use AutomatedEmails\App\Creators\Component\ComponentFileCreator;
use AutomatedEmails\Original\Characters\Suffixed;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class PassableCreatorCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.passable');
        $this->setDescription('');

        $this->addArgument('componentNameNoSuffix', InputArgument::REQUIRED, 'the very useful description');
        //$this->addOption('app', null, InputOption::VALUE_NONE, 'the very useful description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $componentName = new Suffixed(
            text: $input->getArgument('componentNameNoSuffix'),
            suffix: 'Component'
        );

        (object) $componentFileCreator = new ComponentFileCreator(
            componentNameNoSuffix: $componentName->withoutSuffix(),
            componentNameWithSuffix: $componentName->withSuffix(),
            relativeDirectory: 'app/components/Passable/builtin/'
        );

        $componentFileCreator->setFeatures(_(
            'Identifiable',
            'Typeable',
            'HasTemplateOptions',
            'Nameable',
            'Descriptable'
        ));

        $componentFileCreator->create();

        return 1;
    }
}