# Laravel Event Scheduler

[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](code_of_conduct.md)


This Laravel application allows users to schedule events automatically in their free time slots on a calendar.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Make sure you have the following installed:

* PHP 7.3 or higher
* Composer
* Laravel 8.x

### Installing

1. Clone and install the repository

```bash
git clone https://github.com/Jankol643/Calendar.git // clone the repository
cd laravel-event-scheduler // navigate to the project repository
composer install // install the dependencies
```

2. Configure the database connection in the .env file.
```bash
php artisan key:generate //Generate the application key
php artisan migrate // run the database migrations
php artisan migrate // run the database migrations and seeders if you want example data
```

3. Start the development server:
```bash
php artisan serve
```
Now you can access the application in your browser at http://localhost:8000.

### Running the tests

To run the automated tests for this system, execute the following command:
```bash
php artisan test
```

## Deployment

To deploy this application on a live system, follow these steps:

1. Set up a web server (e.g., Apache, Nginx) and configure it to serve your Laravel application.
2. Copy the application files to the web server's document root directory.
3. Configure the web server to use the appropriate PHP version.
4. Set up the necessary database server and configure the database connection in the .env file.
5. Generate the application key using the php artisan key:generate command.
6. Run the database migrations using the php artisan migrate command.
7. Set up any necessary cron jobs to schedule the event scheduling tasks.

## Built with

- Laravel - The web framework used
- Bootstrap - The front-end framework used for styling
- FullCalendar - The calendar component used for displaying events

## Contributing

Please read CONTRIBUTING.md for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

- Jankol643 - initial work

See also the list of [contributors](https://github.com/Jankol643/Calendar/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [License file](https://github.com/Jankol643/Calendar/license) for details.