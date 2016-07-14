# Kyle

[![Latest Stable Version](https://poser.pugx.org/laravelista/kyle/version?format=flat-square)](https://packagist.org/packages/laravelista/kyle)
[![Total Downloads](https://poser.pugx.org/laravelista/kyle/downloads?format=flat-square)](https://packagist.org/packages/laravelista/kyle)
[![License](https://poser.pugx.org/laravelista/kyle/license?format=flat-square)](https://packagist.org/packages/laravelista/kyle)

Kyle is a web application for web developers and small companies to efficiently track and stay on top of future expenses related to web development. We believe that having a calendar with reoccurring meetings or relying on email notifications from service providers is not a trustworthy source of information to bill clients for the services they use. 

Kyle attempts to provide you with a clear and simple way to see which client uses which services and when those service need to be billed. The idea behind Kyle is very simple "Never forget to bill a client for the services that he uses". You can keep track of things like: is the offer sent, did you receive payment and did you send the receipt.

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