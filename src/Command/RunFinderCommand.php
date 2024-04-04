<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Finder\Finder;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:run-finder',
    description: 'Add a short description for your command',
)]
class RunFinderCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connection = ssh2_connect($_ENV['SSH_HOST'], 22);
        ssh2_auth_password($connection, $_ENV['SSH_USER'], $_ENV['SSH_PASS']);
        $sftp = ssh2_sftp($connection);

        $finder = new Finder();
        $finder->in('ssh2.sftp://' . intval($sftp) . $_ENV['SSH_HOST_PATH'])->files();

        if ($finder->count() > 0) {
            foreach ($finder as $k => $file) {
                // echo $file->getMTime() . PHP_EOL;
                echo $k . PHP_EOL;
                echo $file->getBasename() . PHP_EOL;
                echo $file->getFilename() . PHP_EOL;
                echo $file->getFilenameWithoutExtension() . PHP_EOL;
                echo $file->getPathname() . PHP_EOL;
                echo $file->getRelativePathname() . PHP_EOL;
            }
        }

        return Command::SUCCESS;
    }
}
