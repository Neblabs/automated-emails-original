<?php

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\App\Creators\Component\ComponentFileCreator;
use AutomatedEmails\App\Creators\Event\EventFileCreator;
use AutomatedEmails\Original\Characters\Suffixed;
use AutomatedEmails\Original\Creators\Tasks\TestFileCreatorTask;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\a;
use function AutomatedEmails\Original\Utilities\Collection\o;
use function AutomatedEmails\Original\Utilities\Text\i;

Class EventComponentCreatorCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.event');
        $this->setDescription('');

        $this->addArgument('componentNameNoSuffix', InputArgument::REQUIRED, '');
        //$this->addOption('nontyped', null, InputOption::VALUE_NONE, 'implements Tyepable');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $componentName = new Suffixed(
            text: i($input->getArgument('componentNameNoSuffix'))->removeLeft('Event'),
            suffix: 'EventComponent'
        );

        (object) $creators = _(
            o(
                creator: new EventFileCreator(
                    eventName: $componentName->withoutSuffix(),
                    componentName: $componentName->withSuffix()
                ),
                tasks: [new TestFileCreatorTask]
            ),
            o(
                creator: (object) $componentFileCreator = new ComponentFileCreator(
                    componentNameNoSuffix: $componentName->withoutSuffix(),
                    componentNameWithSuffix: $componentName->withSuffix(),
                    relativeDirectory: 'app/components/events/builtin/'
                ),
                tasks: []
            )
        );

        $componentFileCreator->setFeatures(_(
            'Identifiable',
            'Typeable',
            'HasTemplateOptions',
            'Nameable',
            'Descriptable'
        )->filter());

        $creators->forEvery(function(object $creator) {
            $creator->creator->registerCompletionTasks($creator->tasks);
            $creator->creator->create();
        });

        return 1;
    }
}