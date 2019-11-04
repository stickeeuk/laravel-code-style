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

The `stickee-configs` contain good defaults for all projects and the `stickee-resources` contains 
scaffolding which is recommended if you are starting a new project.

You then need to install [Stickee JavaScript Code Style](https://github.com/stickeeuk/javascript-code-style)

```
yarn add --dev stickee-javascript-code-style
```

## Recommended

It's recommended to install [Larastan](https://github.com/nunomaduro/larastan) in the project:

```
composer require --dev nunomaduro/larastan
```

Once installed, you can run `php artisan code:analyse` at any time which gives you a very good insight into your code.

You can add the following snippet to your `.huskyrc` file,
 in the pre-commit part of the file,
 to run this every time you try to commit to Git:

```
 && php artisan code:analyse
```

### Husky (Task Runner)

It's advisable to use [Husky](https://github.com/typicode/husky) as the task runner. The config files 
will already be published using the above command, however you will still need to install husky:

```
yarn add --dev husky lint-staged
```

### PHPCS

PHP-CS-Fixer can be manually ran using:

```
vendor/bin/php-cs-fixer <COMMAND>
```
