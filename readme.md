# Kyle

**Monitor when to bill clients based on the services they use.**

## Create new user

To create a new user use this command:

```
php artisan user:create "John Doe" john@doe.com
```

You will be asked for the password.

## Info

At the start of every year 1st of January a command `occurrences:spawn` is executed using the task scheduler. **Be sure to add Cron entry `* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1` to your server.** This command creates new occurrences for services that will occur in the new year.