<?php

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Builtin\CoreComponents;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\App\Creators\BaseEventComponentCreator\BaseEventComponentFileCreator;
use AutomatedEmails\App\Creators\BaseEventCreator\BaseEventCreatorFileCreator;
use AutomatedEmails\App\Creators\Extensions\CustomRelativeDirectoryCreatorDecorator;
use AutomatedEmails\App\Creators\Extensions\CustomTemplatePathCreatorDecorator;
use AutomatedEmails\App\Creators\Extensions\ExtendedRelativeDirectoryCreatorDecorator;
use AutomatedEmails\App\Creators\Extensions\ExtraTemplateVariablesCreatorDecorator;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Tasks\TestFileCreatorTask;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Tasks\Task;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\a;
use function AutomatedEmails\Original\Utilities\Text\i;

Class EventTemplateCreatorCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.event.template');
        $this->setDescription('creates an event template that extends An existing event');

        $this->addArgument('templateName', InputArgument::REQUIRED, 'The name of them template class');
        $this->addArgument('baseEventId', InputArgument::REQUIRED, 'The name of them original, existing event class');
        $this->addArgument('eventReadableName', InputArgument::REQUIRED, 'Eg: PostStatusChange');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $coreComponents = new CoreComponents;
        (object) $baseEventComponent = $coreComponents->events()->find(
            fn(Identifiable $eventComponent) => $eventComponent->identifier() === $input->getArgument('baseEventId')
        );
        (object) $templateName = i($input->getArgument('templateName'))->upperCaseFirst();
        (string) $eventRelativeDirectory = "app/domain/events/builtin/{$input->getArgument('baseEventId')}/templates";

        (object) $eventComponentCreator = new ExtraTemplateVariablesCreatorDecorator(
            templateVariables: a(
                baseEventComponent: $baseEventComponent,
                baseEventComponentClassName: i($baseEventComponent::class)->explode('\\')->last(),
                baseEventComponentFullyQualifiedClassName: $baseEventComponent::class
            ),
            classFileCreator: new CustomRelativeDirectoryCreatorDecorator(
                relativeDirectory: i($eventRelativeDirectory)->replace('app/domain',replacement: 'app/components')->get(),
                classFileCreator: new CustomTemplatePathCreatorDecorator(
                    templatePath: Env::appDirectory().'/creators/BaseEventComponentCreator/EventTemplateComponentCreatorTemplate.php',
                    classFileCreator: new BaseEventComponentFileCreator(
                        eventName: $templateName,
                        eventReadableName: $input->getArgument('eventReadableName') ?? '',
                        eventRelativeDirectory: $eventRelativeDirectory,
                        postDataTypeComponents: _()
                    )
                )
            )
        );

        $eventComponentCreator->registerCompletionTasks([
            new class(
                $templateName,
                $eventRelativeDirectory,
                $input,
                $baseEventComponent
            ) Extends Task {
                public function __construct(
                    protected StringManager $eventName,
                    protected string $eventRelativeDirectory,
                    protected InputInterface $input,
                    protected Typeable $baseEventComponent
                ) {}
                
                public function run(Collection $taskData)
                {
                    (object) $eventFileCreator = new ExtraTemplateVariablesCreatorDecorator(
                        templateVariables: a(
                            baseEventClassName: _(
                                fullyQualifiedClassName: $this->baseEventComponent->type(),
                                className: i($this->baseEventComponent->type())->explode("\\")->last()
                            )
                        ),
                        classFileCreator: new ExtendedRelativeDirectoryCreatorDecorator(
                            appendPath: '',
                            classFileCreator: new CustomTemplatePathCreatorDecorator(
                                templatePath: Env::appDirectory().'/creators/BaseEventCreator/EventTemplateCreatorTemplate.php',
                                classFileCreator: new BaseEventCreatorFileCreator(
                                    eventName: $this->eventName,
                                    eventRelativeDirectory: $this->eventRelativeDirectory,
                                    actionHook: '',
                                    idsOfdataTypesProvided: _(),
                                    componentClassName: _(
                                        fullyQualifiedClassName: $taskData->get('fullyQualifiedClassName'),
                                        className: $taskData->get('className')
                                    )
                                )
                            )
                        )
                    );

                    
                    $eventFileCreator->registerCompletionTasks([
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