<?php

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\App\Components\Builtin\CoreComponents;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\App\Creators\BaseEventComponentCreator\BaseEventComponentFileCreator;
use AutomatedEmails\App\Creators\BaseEventCreator\BaseEventCreatorFileCreator;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Tasks\TestFileCreatorTask;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Tasks\Task;
use Stringable;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function AutomatedEmails\Original\Utilities\Text\i;
use function AutomatedEmails\Original\Utilities\Collection\_;

Class EventCreatorCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.event');
        $this->setDescription('Creates a new Base event');

        $this->addArgument('evenName', InputArgument::REQUIRED, 'Eg: PostStatusChange');
        $this->addArgument('actionHook', InputArgument::REQUIRED, 'Eg: save_post');
        $this->addArgument('idsOfdataTypesProvided', InputArgument::REQUIRED, 'Eg: post,user');
        $this->addArgument('eventReadableName', InputArgument::OPTIONAL, 'Eg: When the status of a post has changed');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $coreComponents = new CoreComponents;
        (object) $eventName = i($input->getArgument('evenName'))->upperCaseFirst();
        (string) $eventRelativeDirectory = "app/domain/events/builtin/{$eventName}";

        (object) $eventComponentCreator = new BaseEventComponentFileCreator(
            eventName: $eventName,
            eventReadableName: $input->getArgument('eventReadableName') ?? '',
            eventRelativeDirectory: $eventRelativeDirectory,
            postDataTypeComponents: i($input->getArgument('idsOfdataTypesProvided'))->explode(',')->map(fn(string $dataTypeId) => $coreComponents->dataTypes()->find(
                fn(DataTypeComponent $dataTypeComponent) => $dataTypeComponent->identifier() === $dataTypeId
            ))
        );

        $eventComponentCreator->registerCompletionTasks([
            new class(
                $eventName,
                $eventRelativeDirectory,
                $input,
            ) Extends Task {
                public function __construct(
                    protected StringManager $eventName,
                    protected string $eventRelativeDirectory,
                    protected InputInterface $input,
                ) {}
                
                public function run(Collection $taskData)
                {
                    (object) $eventFileCreator = new BaseEventCreatorFileCreator(
                        eventName: $this->eventName,
                        eventRelativeDirectory: $this->eventRelativeDirectory,
                        actionHook: $this->input->getArgument('actionHook'),
                        idsOfdataTypesProvided: i($this->input->getArgument('idsOfdataTypesProvided'))->explode(',')->map(fn($id) => trim($id))->filter(),
                        componentClassName: _(
                            fullyQualifiedClassName: $taskData->get('fullyQualifiedClassName'),
                            className: $taskData->get('className')
                        )
                    );

                    $eventFileCreator->registerCompletionTasks([
                        new TestFileCreatorTask(
                            customTemplatePathAbsolute: dirname(__FILE__).'/templates/EventUniTestTemplate.php',
                        ),
                        new TestFileCreatorTask(
                            customTemplatePathAbsolute: dirname(__FILE__).'/templates/EventIntegrationTemplate.php',
                            baseTargetDirectory: 'tests/integration'
                        )
                    ]);
                    $eventFileCreator->create();
                } 
            } 
        ]);

        $eventComponentCreator->create();

        return 1;        
    }
}