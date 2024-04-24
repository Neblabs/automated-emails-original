<?php declare(strict_types=1);

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Creators\SystemFilesCreator;
use AutomatedEmails\Original\Environment\Env;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

Class TestAndDataSetCreatorCommand extends Command
{
    static $flavors = [
        // the dir path to the method-template.php and data-template.php
        'c' => 'conditions',
        'f' => 'filters',
        'default' => 'default'
    ];

    protected function configure()
    {
        $this->setName('dt');
        $this->setDescription('Create a test method and a data set file with an entry mapped to that method.');

        $this->addArgument('testCaseClass', InputArgument::REQUIRED, '');
        $this->addArgument('methodName', InputArgument::REQUIRED, 'method name without the test prefix. whitespaces are to be converted to under scores!');
        $this->addArgument('dataSetName', InputArgument::REQUIRED);
        $this->addArgument('dataSetKey', InputArgument::REQUIRED, 'p for passes, f for fails, or custom string');
        $this->addArgument('flavor', InputArgument::OPTIONAL, 'flavor: c: conditions, f: filters');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->testFilePath = $this->findPathForFile($input->getArgument('testCaseClass'));
        $this->dataSetName = $input->getArgument('dataSetName');
        $this->methodName = new StringManager($input->getArgument('methodName'));
        $this->dataSetKey = $input->getArgument('dataSetKey');
        $this->selectedFlavor = $input->getArgument('flavor') ?? 'default';

        $this->createDataSetFile();
        $this->addMethodToTestCase();
        $this->addEntryInDataSet();
    }

    protected function addMethodToTestCase()
    {
        (string) $testClassContents = preg_replace(
            '/\}\s*$/', 
            $this->getClassMethodsTemplate(), 
            file_get_contents($this->testFilePath->get())
        );

        file_put_contents($this->testFilePath->get(), $testClassContents);
    }

    protected function addEntryInDataSet()
    {
        (string) $datasetcontents = preg_replace(
            '/\]\;\s*$/', 
             $this->getDataSetFileEntryTemplate(), 
            file_get_contents($this->getDataSetFile())
        );
        file_put_contents($this->getDataSetFile(), $datasetcontents);
    }
    
    protected function createDataSetFile()
    {
        if (!file_exists($this->getDataSetFile())) {
            if (!is_dir($directory = pathinfo($this->getDataSetFile())['dirname'])) {
                mkdir($directory, 0777, $recursive = true);
            }
            file_put_contents($this->getDataSetFile(), $this->getDataSetTemplate());
        }
    }

    protected function getDataSetFile() : string
    {
        (array) $fileParts = pathinfo($this->testFilePath->get());
        (string) $finalName = str_replace('.php', "Data-{$this->dataSetName}.php", $fileParts['basename']);

        return "{$fileParts['dirname']}/dataSets/$finalName";
    }

    protected function findPathForFile(string $testCaseClass) : StringManager
    {
        (object) $finder = new Finder;

        $finder->files()->in(Env::directory().'/tests')->name("{$testCaseClass}.php");

        if (!$finder->hasResults()) {
            throw new \Exception('testCaseClass file not found. Surray!');
        }

        if (count($finder) > 1) {
            throw new \Exception('not so fast! there is more than one testCaseClass file with that name');
        }

        return new StringManager(array_values(iterator_to_array($finder))[0]->getpathName());
    }

    protected function getFullDataSetKey() : StringManager
    {
        switch ($this->dataSetKey) {
            case 'f':
                return new StringManager('fails');
                break;
            case 'p':
                return new StringManager('passes');
                break;
            default:
                return new StringManager($this->dataSetKey);
                break;
        }
    }
    

    protected function getDataSetTemplate() : string
    {
        return <<<TEMPLATE
<?php

return [

];
TEMPLATE;
    }

    protected function getClassMethodsTemplate() : string
    {
        (string) $keyPrefix = $this->getFullDataSetKey()->replace('-', '_')->ensureLeft('_');
        (string) $methodName = $this->methodName->replace(' ', '_')->ensureLeft('test_')->ensureRight($keyPrefix);
        (array) $datasetfileparths = pathinfo($this->getDataSetFile());
        (string) $providerName = $methodName->replace('test_', '').$this->getFullDataSetKey()->replace('-', '_')->ensureLeft('_')->ensureRight('Provider');

        return <<<TEMPLATE

    {$this->getMethodTemplate($methodName, $providerName)}

    public function {$providerName}()
    {
        return \$this->getDataFromSet(__DIR__, '{$datasetfileparths['basename']}', '{$this->getFullDataSetKey()}');
    }
}
TEMPLATE;
    }

    protected function getMethodTemplate(StringManager $methodName, string $providerName)
    {
        return require Env::directory().'app/commands/dataSets/flavors/'.static::$flavors[$this->selectedFlavor].'/method-template.php';
    }

    protected function getDataSetFileEntryTemplate() : string
    {
        (string) $dataSetKey = $this->getFullDataSetKey();

        // $this is also passed.

        (string) $template = require Env::directory().'app/commands/dataSets/flavors/'.static::$flavors[$this->selectedFlavor].'/data-template.php';

        return <<<TEMPLATE
    {$template}
];
TEMPLATE;
    }
}  