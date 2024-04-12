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
    name: 'app:finder-local',
    description: '',
)]
class RunFinderLocalCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__);

        foreach ($finder as $file) {
            echo $file->getRealPath() . PHP_EOL;
            echo $file->getPathname() . PHP_EOL;
            echo $file->getRelativePathname() . PHP_EOL;
            echo $file->getMTime() . PHP_EOL;
        }

        return Command::SUCCESS;
    }
}

