<?php

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\App\Creators\Component\ComponentFileCreator;
use AutomatedEmails\Original\Characters\Suffixed;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use function AutomatedEmails\Original\Utilities\Collection\o;

Class DataComponentCreatorCommand extends Command
{
    protected function configure()
    {
        $this->setName('new.data');
        $this->setDescription('');

        $this->addArgument('componentNameNoSuffix', InputArgument::REQUIRED, '');
        //$this->addOption('app', null, InputOption::VALUE_NONE, 'the very useful description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (object) $componentName = new Suffixed(
            text: $input->getArgument('componentNameNoSuffix'),
            suffix: 'Data'
        );

        //this will be a todo:
        (object) $creators = _(
            //the postdata
            //the postsdata
            //the postdatatype
            //the postvalue
            //the postvalues
            //
            //the posttitle, postbody, etc
            //
            //then the postDatacomponent
            //and the posttitlecompoent
            o(
                creator: (object) $componentFileCreator = new ComponentFileCreator(
                    componentNameNoSuffix: $componentName->withoutSuffix(),
                    componentNameWithSuffix: $componentName->withSuffix(),
                    relativeDirectory: 'app/components/conditions/builtin/'
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
        return 1;        
    }
}