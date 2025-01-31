# Slack for Laravel

This package allows you to use [Slack for PHP](https://github.com/maknz/slack) easily and elegantly in your Laravel 4 or 5 app. Read the instructions below to get setup, and then head on over to [Slack for PHP](https://github.com/maknz/slack) for usage details.

## Requirements

Laravel 4 or 5.

## Installation

You can install the package using the [Composer](https://getcomposer.org/) package manager. You can install it by running this command in your project root:

```sh
composer require oslegend23/slack-laravel
```

Then [create an incoming webhook](https://my.slack.com/services/new/incoming-webhook) for each Slack team you'd like to send messages to. You'll need the webhook URL(s) in order to configure this package.

## Laravel 5

Add the `OsLegend23\Slack\SlackServiceProvider` provider to the `providers` array in `config/app.php`:

```php
'providers' => [
  OsLegend23\Slack\SlackServiceProvider::class,
],
```

Then add the facade to your `aliases` array:

```php
'aliases' => [
  ...
  'Slack' => OsLegend23\Slack\Facade::class,
],
```

Finally, publish the config file with `php artisan vendor:publish`. You'll find it at `config/slack.php`.

## Laravel 4

Add the `OsLegend23\Slack\Laravel\ServiceProvider` provider to the `providers` array in `app/config.php`:

```php
'providers' => [
  ...
  'OsLegend23\Slack\SlackServiceProvider',
],
```

Then add the facade to your `aliases` array:

```php
'aliases' => [
  ...
  'Slack' => 'OsLegend23\Slack\Facade',
],
```

Finally, publish the config file with `php artisan config:publish oslegend23/slack`. You'll find the config file at `app/config/packages/oslegend23/slack-laravel/config.php`.

## Configuration

The config file comes with defaults and placeholders. Configure at least one team and any defaults you'd like to change.

## Usage

The Slack facade is now your interface to the library. Any method you see being called an instance of `OsLegend23\Slack\Client` is available on the `Slack` facade for easy use.

Note that if you're using the facade in a namespace (e.g. `App\Http\Controllers` in Laravel 5) you'll need to either `use Slack` at the top of your class to import it, or append a backslash to access the root namespace directly when calling methods, e.g. `\Slack::method()`.

```php
// Send a message to the default channel
Slack::send('Hello world!');

// Send a message to a different channel
Slack::to('#accounting')->send('Are we rich yet?');

// Send a private message
Slack::to('@username')->send('psst!');
```

Now head on over to [Slack for PHP](https://github.com/maknz/slack) for more examples, including attachments and message buttons.

