# Stickee Laravel Code Style

This repository contains config files for tools for Laravel projects.

## Usage

First install this package:

```
composer require --dev stickee/laravel-code-style
```

You should then be able to publish the assets using following command:
```
php artisan vendor:publish
```

The `stickee-configs` contain good defaults for all projects, and the `stickee-resources` contains
scaffolding which is recommended if your starting a new project.

You then need to install js code style

```
npm install stickee-javascript-code-style
```

Highly recommend [Husky](https://github.com/typicode/husky) to greatly improve the quality of code committed into GIT.
It automates a LOT of tasks. Have a peek into `.huskyrc` and `.lintstagedrc` for an insight into what it does.

```
npm install --save-dev husky lint-staged stylelint stylelint-config-sass-guidelines imagemin-lint-staged
```

Once installed, please confirm the `.huskyrc` and `.lintstagedrc` are doing what you expect. Some projects
(e.g. PyroCMS) may not have the same structure, or you may want to disable phpunit tests if tests become slow.

## Recommended

It's recommended to install [Larastan](https://github.com/nunomaduro/larastan) in the project.

```
composer require --dev nunomaduro/larastan
```

Once installed, you can run `./vendor/bin/phpstan analyse` at anytime to scan your whole project, which gives you a very good insight into your code.
By default this is already set up in your `.lintstagedrc` file, within the `"*.php"` block.

```
"./vendor/bin/phpstan analyse --no-ansi --no-progress",
```

### PHPCS

PHP-CS-Fixer can be manually ran using:

```
./vendor/bin/php-cs-fixer <COMMAND>
```
