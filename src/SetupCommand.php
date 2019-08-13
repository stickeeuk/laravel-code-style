<?php

namespace Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

use Symfony\Component\Yaml\Yaml;
use Nette\Neon\Neon;

class BuildCommand extends Command
{
    const COMMAMD_NAME = 'build';

    private $phpCodeStylePath = __DIR__ . '/../vendor/stickee/php-code-style/dist/';

    public function configure()
    {
        $this->setName(self::COMMAMD_NAME)
            ->setDescription('Copies necessary files into the project root')
            ->setHelp('This command copies over files');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Stickee Laravel Code Style',
            '==========================',
        ]);

        $this->cleanDistDirectory();

        $this->updatePHPCsFile();
        $this->updateHuskyFile();
        $this->updateLintStagedFile();

        $output->writeln([
            '<info>vendor/stickee/laravel-code-style/dist/.php_cs created</>',
            '<info>vendor/stickee/laravel-code-style/dist/.huskyrc created</>',
            '<info>vendor/stickee/laravel-code-style/dist/.lintstagedrc created</>',
        ]);
    }

    private function cleanDistDirectory()
    {
        $files = glob(__DIR__ . '/../dist/*');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    private function copyFile($fileName) {
        copy(__DIR__ . '/../resources/' . $fileName, __DIR__ . '/../dist/' . $fileName);
    }

    private function updatePHPCsFile()
    {
        $this->copyFile('.php_cs');
    }

    private function updateHuskyFile()
    {
        $this->copyFile('.huskyrc');
    }

    private function updateLintStagedFile()
    {
        $this->copyFile('.lintstagedrc');
    }
}
