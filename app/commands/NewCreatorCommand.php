<?php declare(strict_types=1);

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\Original\Environment\Env;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

Class NewCreatorCommand extends Command
{
    static $types = [
        'condition' => [
            'template' => 'templates/condition-template.php',
            'targetDirectory' => 'app/conditions/builtIn/conditions'
        ],
        'filter' => [
            'template' => 'templates/filter-template.php',
            'targetDirectory' => 'app/conditions/builtIn/filters'
        ],
        'validator' => [
            'template' => 'templates/validator-template.php',
            'targetDirectory' => 'app/validators'
        ],
        'dcomp' => [
            'template' => 'templates/dashboard-component-template.php',
            'targetDirectory' => 'app/scripts/dashboard/src',
            'extension' => 'js'
        ]
    ];

    protected function configure()
    {
        $this->setName('new');
        $this->setDescription('Create a component file.');

        $this->addArgument('type', InputArgument::REQUIRED, 'condition, filter');
        $this->addArgument('componentName', InputArgument::REQUIRED, 'name, no directories');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->componentName = $input->getArgument('componentName');
        $this->type = $input->getArgument('type');

        $this->checkForErrors();
        $this->createComponent();
    }

    protected function createComponent()
    {
        (string) $componentName = $this->componentName;
        
        file_put_contents(
            $this->getTargetFileName(), 
            (require Env::directory().'app/commands/'.static::$types[$this->type]['template'])
        );
    }

    protected function getTargetFileName()
    {
        (string) $extension = static::$types[$this->type]['extension'] ?? 'php';
        
        return Env::directory().static::$types[$this->type]['targetDirectory']."/{$this->componentName}.{$extension}";
    }

    protected function checkForErrors()
    {
        if (!isset(static::$types[$this->type])) {
            throw new \Exception("Type: {$this->type} not found.");
        }

        if (file_exists($this->getTargetFileName())) {
            throw new \Exception("Target file already exists. Abortin'...");
        }
    }
}  