<?php

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\App\Creators\Component\ConditionComponentFileCreator;
use AutomatedEmails\App\Creators\ConditionOptions\ConditionOptionsFileCreator;
use AutomatedEmails\App\Creators\Condition\ConditionFileCreator;
use AutomatedEmails\Original\Characters\Suffixed;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Tasks\TestFileCreatorTask;
use AutomatedEmails\Original\Tasks\Task;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\o;
use function AutomatedEmails\Original\Utilities\Text\i;

Class ConditionComponentCreatorCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.condition');
        $this->setDescription('');

        $this->addArgument('componentNameNoSuffix', InputArgument::REQUIRED, 'eg: PostStatus');
        //$this->addOption('app', null, InputOption::VALUE_NONE, 'the very useful description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $componentName = new Suffixed(
            text: $input->getArgument('componentNameNoSuffix'),
            suffix: 'ConditionComponent'
        );
        (object) $conditionClass = _();

        (object) $creators = _(
            o(
                creator: new ConditionFileCreator(
                    conditionNameNoSuffix: $componentName->withoutSuffix(),
                ),
                tasks: [
                    new TestFileCreatorTask,
                    new class ($conditionClass) extends Task {
                        public function __construct(
                            protected Collection $conditionClass
                        ) {}
                        
                        public function run(Collection $taskData)
                        {
                            $this->conditionClass->append(_(
                                className: $taskData->get('className'),
                                fullyQualifiedClassName: $taskData->get('fullyQualifiedClassName')
                            ));
                        } 
                    }
                ]
            ),
            o(
                creator: new ConditionOptionsFileCreator(
                    conditionNameNoSuffix: $componentName->withoutSuffix(),
                ),
                tasks: [new TestFileCreatorTask]
            ),
            o(
                creator: (object) $componentFileCreator = new ConditionComponentFileCreator(
                    componentNameNoSuffix: $componentName->withoutSuffix(),
                    componentNameWithSuffix: $componentName->withSuffix(),
                    relativeDirectory: 'app/components/conditions/builtin/',
                    conditionClass: $conditionClass
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