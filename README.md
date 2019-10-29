# wp-kit/queue

This is a wp-kit component that provides a queue system when using Bedrock and Redis

## Installation

```php
composer require "wp-kit/queue"
```

## Setup

### Add Service Provider

Just register the service provider and facade in the providers config and theme config:

```php
//inside theme/resources/config/providers.config.php

return [
	...,
    WPKit\Queue\QueueServiceProvider::class
];
```

### Add Config File

The recommended method of installing config files for ```wp-kit``` components is via ```wp kit vendor:publish``` command.

First, [install WP CLI](http://wp-cli.org/), and then install this component, ```wp kit vendor:publish``` will automatically be installed with ```wp-kit/utils```, once installed you can run:

```wp kit vendor:publish```

For more information, please visit [```wp-kit/utils```](https://github.com/wp-kit/utils#commands).

Alternatively, you can place the [config file(s)](config) in your ```theme/resources/config``` directory manually.

### Update Composer Paths

```php
//inside theme/resources/config/loading.config.php

return [
	...,
    'Theme\\Jobs\\' => resources_path('jobs'),
    'Theme\\Jobs\\Handlers\\' => resources_path('jobs/handlers')
];
```

## How To Use

Examples of how to use can be found in the [jobs folder](jobs). Add these to you ```theme/resources/jobs``` directory manually.

## Get Involved

To learn more about how to use ```wp-kit``` check out the docs:

[View the Docs](https://github.com/wp-kit/theme/tree/docs/README.md)

Any help is appreciated. The project is open-source and we encourage you to participate. You can contribute to the project in multiple ways by:

- Reporting a bug issue
- Suggesting features
- Sending a pull request with code fix or feature
- Following the project on [GitHub](https://github.com/wp-kit)
- Sharing the project around your community

For details about contributing to the framework, please check the [contribution guide](https://github.com/wp-kit/theme/tree/docs/Contributing.md).

## Requirements

Wordpress 4+

PHP 5.6+

## License

wp-kit/queue is open-sourced software licensed under the MIT License.
