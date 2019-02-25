<?php

require './index.php';

use Nette\Neon\Neon;

$path = '../../../stickee/php-code-style/';
$fileName = 'phpstan.neon';
$laravelFileName = 'laravel.phpstan.neon';

if (! file_exists($path . $fileName) || ! file_Exists($laravelFileName)) {
    throw new \Exception('Cannot find required files.');
}

// read original config
$fileHandle = fopen($path . $fileName, 'r');
$file = fread($fileHandle, filesize($fileName));
$config = Neon::decode($file);
fclose($fileHandle);

// read laravel config
$laravelConfigHandle = fopen($laravelFileName, 'r');
$laravelConfigFile = fread($laravelConfigHandle, filesize($laravelFileName));
$laravelConfig = Neon::decode($laravelConfigFile);

// merge configs
$config = array_merge($config, $laravelConfig);

// write and close
$fileHandle = fopen($fileName, 'w');
fwrite($fileHandle, Neon::encode($config, Neon::BLOCK));
fclose($fileHandle);
