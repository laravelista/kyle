# Kyle


[![Latest Stable Version](https://poser.pugx.org/laravelista/kyle/version)](https://packagist.org/packages/laravelista/kyle)
[![Total Downloads](https://poser.pugx.org/laravelista/kyle/downloads)](https://packagist.org/packages/laravelista/kyle)
[![Latest Unstable Version](https://poser.pugx.org/laravelista/kyle/v/unstable)](//packagist.org/packages/laravelista/kyle)
[![License](https://poser.pugx.org/laravelista/kyle/license)](https://packagist.org/packages/laravelista/kyle)
[![Build Status](https://travis-ci.org/laravelista/kyle.svg?branch=master)](https://travis-ci.org/laravelista/kyle)
[![composer.lock available](https://poser.pugx.org/laravelista/kyle/composerlock)](https://packagist.org/packages/laravelista/kyle)

Kyle is a web application built with Laravel for web developers and small companies to efficiently track and stay on top of yearly expenses related to services. We believe that having a calendar with reoccurring meetings or relying on email notifications from service providers is not a trustworthy source of information to bill clients for the services they use. 

Kyle attempts to provide you with a clear and simple way to see which client uses which services and when those service need to be billed. The idea behind Kyle is very simple "Never forget to bill a client for the services that he uses".

## Features

- Overview of services for current and upcoming month
- Service breakdown by month
- Keep track of services that a client uses
- Group services by custom defined categories
- Yearly report and statistics
- Track is the offer sent, payment received and receipt sent
- Email notifications (Planned)

## Installation

Install by issuing the Composer `create-project` command in your terminal:

```
composer create-project --prefer-dist laravelista/kyle
```

### Sample data

To populate Kyle with sample data and see how the Overview and Report pages look like, use this command:

```
php artisan migrate --seed
```

> Warning! This command will populate the database with a lot of sample data. Use only while testing or if you understand what will happen once this command has triggered.

This will create a sample user with which you can login:

| Email                 | Password |
|-----------------------|----------|
| sample@user.dev       | password |

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