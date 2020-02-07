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

You then need to install eslint configs

```
npx install-peerdeps --dev eslint-config-stickee
```

Add `imagemin-lint-staged` to automatically minimize committed image files

```
npm i --save-dev imagemin-lint-staged
```

Ideally [Husky](https://github.com/typicode/husky) should then be installed. Please see instructions below.

## Recommended

It's recommended to install [Larastan](https://github.com/nunomaduro/larastan) in the project.

```
composer require --dev nunomaduro/larastan
```

Once installed, you can run `./vendor/bin/phpstan analyse` at anytime which gives you a very good insight into your code.

You can add the following snippet to your .lintstagedrc file, within the `"*.php"` block to run Larastan on the files committed:

```
"php ./vendor/bin/phpstan analyse --no-ansi --no-progress",
```

### Husky (Task Runner)

It's advisable to use [Husky](https://github.com/typicode/husky) as the task runner. The config files 
should already be published using the above command, however you will still need to install husky:

```
npm install husky
npm install lint-staged
```

### PHPCS

PHP-CS-Fixer can be manually ran using:

```
vendor/bin/php-cs-fixer <COMMAND>
```
