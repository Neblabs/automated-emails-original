<?php

namespace AutomatedEmails\App\Commands;

use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Events\Subscriber;
use League\CLImate\CLImate;
use ReflectionClass;
use stdClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

Class QuickConsolePlaygroundCommand extends Command
{
    protected function configure()
    {
        $this->setName('play');
        $this->setDescription('Generic console playground for quick tests.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (string) $php = Env::settings()->binaries->php;
        (string) $file = '/Applications/MAMP/htdocs/automated-emails/wp-content/plugins/automated-emails/app/domain/eventData/EventDataSet.php';
        
        echo "\t".str_replace('%', '', implode("\n\t", explode("\n", shell_exec("{$php} ./vendor/bin/parallel-lint {$file} --colors --no-progress"))));
        return;

        var_dump(new textgetter);
        return;
        (object) $climate = new CLImate;

        $climate->out(' ');
        $climate->tab('  ');
        $climate->backgroundBlue()->bold()->blink()->inline(' NEW! ');
        $climate->lightBlue()->inline(' Validator: ');
        $climate->blue()->bold()->line('UsersValidator');
        $climate->darkGray()->out($fileName = '               /Applications/MAMP/htdocs/automated-emails/wp-content/plugins/automated-emails/original/validation/validators/ValidType.php');
        $climate->tab(' ')->darkGray()->dim()->underline()->inline(str_pad(' ', strlen($fileName)-8));
        $climate->out("\n");

        $climate->out(' ');
        $climate->tab('  ');
        $climate->backgroundBlue()->bold()->blink()->inline(' NEW! ');
        $climate->lightBlue()->inline(' Validator: ');
        $climate->blue()->bold()->line('UsersValidator');
        $climate->darkGray()->out($fileName = '               /Applications/MAMP/htdocs/automated-emails/wp-content/plugins/automated-emails/original/validation/validators/ValidType.php');
        $climate->tab(' ')->darkGray()->dim()->underline()->inline(str_pad(' ', strlen($fileName)-8));
        $climate->out("\n");

        $climate->out(' ');
        $climate->tab('  ');
        $climate->backgroundBlue()->bold()->blink()->inline(' NEW! ');
        $climate->lightBlue()->inline(' Validator: ');
        $climate->blue()->bold()->line('UsersValidator');
        $climate->darkGray()->out($fileName = '               /Applications/MAMP/htdocs/automated-emails/wp-content/plugins/automated-emails/original/validation/validators/ValidType.php');
        $climate->tab(' ')->darkGray()->dim()->underline()->inline(str_pad(' ', strlen($fileName)-8));
        $climate->out("\n");
        // [NEW!] Validator - UsersValidator
    }
}

/*
class a {
    function func(): mixed {

    }
}

class b extends a {
    protected b $a;

    function func() : int {

    }
}*/