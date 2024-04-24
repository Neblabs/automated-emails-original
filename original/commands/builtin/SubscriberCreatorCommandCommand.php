<?php

namespace AutomatedEmails\Original\Commands\BuiltIn;

use AutomatedEmails\Original\Creators\Subscriber\SubscriberFileCreator;
use AutomatedEmails\Original\Creators\Subscriber\SubscriberRegistratorTask;
use AutomatedEmails\Original\Creators\Tasks\TestFileCreatorTask;

use function AutomatedEmails\Original\Utilities\Collection\_;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

Class SubscriberCreatorCommandCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.subscriber');
        $this->setDescription('Creates and registers a new Subscriber by default in app/events');

        $this->addArgument('subscriberNameNoPrefixWillBeAdded', InputArgument::REQUIRED, 'the name of the subscriber class');

        $this->addArgument(
            name: 'actionHookName', 
            mode: InputArgument::OPTIONAL,
            description: 'The name of the hook. If none given, it will not be registered.'
        );

        $this->addOption('original', null, InputOption::VALUE_NEGATABLE, 'put it in original/subscribers instead of app/subscribers');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $subscriberFileCreator = new SubscriberFileCreator(
            subscriberName: $input->getArgument('subscriberNameNoPrefixWillBeAdded'),
            createInOriginal: (boolean) $input->getOption('original')           
        );

        $subscriberFileCreator->registerCompletionTasks(_(
            ($hookName = $input->getArgument('actionHookName'))? new SubscriberRegistratorTask(
                $hookName
            ) : null,
            new TestFileCreatorTask
        )->filter()->asArray());

        $subscriberFileCreator->create();

        return 1;   
    }
}