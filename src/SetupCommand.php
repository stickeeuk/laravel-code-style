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

        $this->updatePHPStanFile();
        $this->updatePHPCsFile();
        $this->updateGrumPHPFile();

        $output->writeln([
            '<info>vendor/stickee/laravel-code-style/dist/grumphp.yml created</>',
            '<info>vendor/stickee/laravel-code-style/dist/.php_cs created</>',
            '<info>vendor/stickee/laravel-code-style/dist/phpstan.neon created</>',
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

    private function updatePHPStanFile()
    {
        $fileName = 'phpstan.neon';

        $laravelFileName = __DIR__ . '/../resources/laravel.phpstan.neon';

        // read original config
        $fileHandle = fopen($this->phpCodeStylePath . $fileName, 'r');
        $file = fread($fileHandle, filesize($this->phpCodeStylePath . $fileName));
        $config = Neon::decode($file);
        fclose($fileHandle);

        // read laravel config
        $laravelConfigHandle = fopen($laravelFileName, 'r');
        $laravelConfigFile = fread($laravelConfigHandle, filesize($laravelFileName));
        $laravelConfig = Neon::decode($laravelConfigFile);

        // merge configs
        $config = array_merge($config, $laravelConfig);

        // write and close
        $fileHandle = fopen(__DIR__ . '/../dist/' . $fileName, 'w');
        fwrite($fileHandle, Neon::encode($config, Neon::BLOCK));
        fclose($fileHandle);
    }

    private function updatePHPCsFile()
    {
        $fileName = '.php_cs';
        copy(__DIR__ . '/../resources/' . $fileName, __DIR__ . '/../dist/' . $fileName);
    }

    private function updateGrumPHPFile()
    {
        $fileName = 'grumphp.yml';

        // parsing config files
        $config = Yaml::parseFile($this->phpCodeStylePath . $fileName);
        $laravelConfig = Yaml::parseFile($fileName);

        // merge configs
        $config = array_merge_recursive($config, $laravelConfig);

        // we dont need the certain php-code-style configs merged so reset this
        $config['parameters']['tasks']['phpstan'] = $laravelConfig['parameters']['tasks']['phpstan'];
        $config['parameters']['tasks']['phpcsfixer2'] = $laravelConfig['parameters']['tasks']['phpcsfixer2'];

        // save config file
        file_put_contents(__DIR__ . '/../dist/grumphp.yml', Yaml::dump($config));
    }
}
