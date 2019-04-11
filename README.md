# Stickee Laravel Code Style

This repository contains config files for tools for Laravel projects.

You will also need the [stickee/php-code-style](https://github.com/stickee/php-code-style) package which will also be installed alongside this package.

## Usage

First install this package:

```
composer require --dev stickee/laravel-code-style
```

and then pass the `-c`/`--c`/`--config` option to the tool you wish to use and use `vendor/stickee/laravel-code-style/dist/<config>.yml` as the path.

### GrumPHP

GrumPHP can be ran using:

```
vendor/bin/grumphp <COMMAND> -c vendor/stickee/laravel-code-style/dist/grumphp.yml
```

### PHPStan

PHPStan can be ran using:

```
vendor/bin/phpstan <COMMAND> -c vendor/stickee/laravel-code-style/dist/phpstan.neon
```

### PHPCS

PHP-CS-Fixer can be ran using:

```
vendor/bin/phpcs <COMMAND> --config vendor/stickee/php-code-style/dist/.phpcs
```

## Development

This repository depends on [stickee/php-code-style](https://github.com/stickee/php-code-style) to generate the config files for Laravel. Each time the PHP code style repository is updated this repository also needs updating by running `bin/stickee-laravel-code-style build`; The `dist` folder is also committed so that this repository is ready to use simply by requiring it.