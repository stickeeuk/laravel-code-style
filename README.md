# Stickee Laravel Code Style

This repository contains config files for tools for Laravel projects.

## Usage

First install this package:

```
composer require --dev stickee/laravel-code-style
```

You should then be able to publish the assets using the `php artisan vendor:publish` command.

The `stickee-configs` contain good defaults for all projects, and the `stickee-resources` contains 
scaffolding which is recommended if your starting a new project.

You then need to install eslint configs

```
npx install-peerdeps --dev eslint-config-stickee
```

### Husky (Task Runner)

It's advisable to use [Husky](https://github.com/typicode/husky) as the task runner. The config files 
should already be published using the above command, however you will still need to install husky:

```
npm install husky
npm install lint-staged
```

### PHPCS

PHP-CS-Fixer can be ran using:

```
vendor/bin/phpcs <COMMAND>
```
