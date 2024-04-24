<?php

namespace AutomatedEmails\Original\Commands\BuiltIn;

use AutomatedEmails\Original\Cache\MemoryCache;
use AutomatedEmails\Original\Creators\SystemFilesCreator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

Class FileCreatorCommand extends Command
{
    protected function configure()
    {
        $this->cache = new MemoryCache;

        $this->setName('create');
        $this->setDescription('Create system files');

        $this->addArgument('type', InputArgument::REQUIRED, '');
        $this->addArgument('name', InputArgument::REQUIRED, '');
        $this->addArgument('optionalArgument1', InputArgument::OPTIONAL, '');

        (object) $options = new Collection([]);
        
        foreach ($this->getCreatorCommands() as $creatorCommand) {
            foreach ($creatorCommand->getOptions() as $option) {
                if ($option->have())
            }
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // take the rsgitered commands and execute based on the crator
        (object) $SystemFilesCreator = new SystemFilesCreator([
            'type' => $input->getArgument('type'),
            'name' => $input->getArgument('name'),
            'extra' => $input->getArgument('optionalArgument1')
        ]);

        $SystemFilesCreator->create();
    }
}