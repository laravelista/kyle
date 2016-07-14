# Kyle

**Monitor when to bill clients based on the services they use.**

- Never forget to bill a client for the services he uses
- Built on Laravel 5.2

## Installation

Install by issuing the Composer `create-project` command in your terminal:

```
composer create-project --prefer-dist laravelista/kyle
```

## Create new user

To create a new user use this command:

```
php artisan user:create "John Doe" john@doe.com
```

You will be asked for the password.

## Info

At the start of every year 1st of January a command `occurrences:spawn` is executed using the task scheduler. 

Be sure to add Cron entry to your server:

```
* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
```

This command creates new occurrences for services that will occur in the new year.

## License

Kyle is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)