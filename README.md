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

## How To Use

Examples of how what a Job file should look like can be found in the [jobs folder](jobs). 

Add these to you `bedrock/root/jobs` directory manually.

Make sure you are running the queue in a shell window, or via Supervisor:

```
vendor/bin/bedrock-queue-worker
```

You can then dispatch jobs within your wp-kit code as follows:

```php
ExampleJob::dispatch('bar');
```

You should then see the string `bar` echo'd in the shell window.

Also, in `bedrock/root/logs` folder there will be a queue file, you could open it or `tail` it and see the following:

```
2019-10-29 15:34:40 Processing: Bedrock\Jobs\ExampleJob
2019-10-29 15:34:42 Processed: Bedrock\Jobs\ExampleJob
```

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
