<?php

namespace AutomatedEmails\Original\Commands\BuiltIn;

use AutomatedEmails\Original\Deployment\Builder;
use AutomatedEmails\Original\Deployment\Builders\RemoveDeletedFilesBuilder;
use AutomatedEmails\Original\Deployment\Builders\ResetMirrorBuilder;
use AutomatedEmails\Original\Deployment\Builders\TransformersBuilder;
use AutomatedEmails\Original\Deployment\Builders\WriteableDirectoryBuilder;
use AutomatedEmails\Original\Deployment\Directories\Directories;
use AutomatedEmails\Original\Deployment\Files\Abilities\FileSystem;
use AutomatedEmails\Original\Deployment\Files\Changessetters\ChangedFilesSetter;
use AutomatedEmails\Original\Deployment\Files\ValidatableFilesystem;
use AutomatedEmails\Original\Deployment\Files\Changessetters\DeletedFilesSetter;
use AutomatedEmails\Original\Deployment\Files\FileVersionsFactory;
use AutomatedEmails\Original\Deployment\Files\Files;
use AutomatedEmails\Original\Deployment\Files\UnwriteableSourceFileSystemValidatorFactory;
use AutomatedEmails\Original\Deployment\Processablefiles\FilesChangedValidator;
use AutomatedEmails\Original\Deployment\SettingsReader;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\TransformersFactory;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Installation\Executables\Abilities\ExecutableComposite;
use AutomatedEmails\Original\Installation\Executables\Abilities\ExecutableWithOwnValidation;
use AutomatedEmails\Original\Installation\Executables\Abilities\ExecutableWithValidation;
use SplFileInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Finder\Finder;
use function AutomatedEmails\Original\Utilities\Collection\_;

Class BuildManagerCommand extends Command
{
    public function __construct(
        string $name = null  
    ) {

        parent::__construct($name);
    }
    
    protected function configure()
    {
        $this->setName('build');
        $this->setDescription('Creates a compressed production version.');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*
        (object) $directories = new Directories(Env::settings()->directories);
        (object) $buildSettings = (new SettingsReader)->settings;
        (object) $fileSysytem = new ValidatableFilesystem(
            filesystem: new SymfonyFilesystem,
            fileSystemValidatorFactory: new UnwriteableSourceFileSystemValidatorFactory($directories)
        );
        (object) $transformersFactory = new TransformersFactory;

        (object) $files = new Files(
            finder: new Finder, 
            buildSettings: $buildSettings, 
            directories: $directories,
            fileVersionsFactory: new FileVersionsFactory($directories)
        );


        (object) $builders = new ExecutableComposite(_(
            // the builder responsible for creating the mirror directory
            //new ExecutableWithOwnValidation(
              //  new ResetMirrorBuilder($directories, $files, $fileSysytem)
            //),
            new DeletedFilesSetter($files), 
            new ChangedFilesSetter($files),
            // here the builder will compare the (source) to the (mirror) and then update the (build) accordingly to the ONLY FILES that need changing
            new ExecutableWithValidation(
                validator: new FilesChangedValidator($files),
                executable: new ExecutableComposite(_(
                    new RemoveDeletedFilesBuilder(
                        $directories, 
                        $files, 
                        $fileSysytem
                    ),
                    new TransformersBuilder(
                        $directories, 
                        $files, 
                        $fileSysytem, 
                        transformers: $transformersFactory->create($buildSettings->scripts->singleFile)
                    )
                )),
            )
        ));

        $builders->execute();



        return 1;*/

        (object) $builder = new Builder($output);

        $builder->build();

        return 1;
    }
}