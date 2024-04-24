<?php

namespace AutomatedEmails\Original\Commands\BuiltIn;

use React\ChildProcess\Process;
use React\EventLoop\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\SplFileInfo;

Class BuildWatcherCommandCommand extends Command
{
    protected function configure()
    {
        $this->setName('watch');
        $this->setDescription('Builds on file changes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (array) $directories = ['.'];

        (object) $process = new Process(
            sprintf('fswatch --recursive %s', implode(' ', $directories))
        );

        (object) $loop = Factory::create();

        $process->start($loop);

        $process->stderr->on('data', function ($data) use($output) : void {
            $output->writeln($data);
        });

        $process->stdout->on('data', function ($data) use ($output, $process): void {
            //
            // 5 actions:
            // -file created
            // -file edited
            // -file deleted
            // -file renamed
            // -file moved
            //
            //
            // only if its watchable (php only, all from the base directpry, not vendor/, etc)
            (string) $filename = trim($data);
            (object) $file = new \SplFileInfo($filename);;
            $output->writeln('gotten data: '.$data);
            //dump(filemtime($filename), $file->getMTime(), $file->getCTime(), file_get_contents($filename));
            unset($file);

            sleep(2);
            echo 'terminating';
            $process->terminate();
        });

        $loop->run();

        return 1;        
    }
}