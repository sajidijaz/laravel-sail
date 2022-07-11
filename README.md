# Task

Setup an API which exposes posts and todos. Both should be readable and writeable. It is also possible to change existing entries. API should support pagination and filtering on all fields.

## Installation

We are using the [laravel sail](https://laravel.com/docs/9.x/sail/) to install laravel project and other dependencies.
You may install the application's dependencies by navigating to the application's directory and executing the following command. This command uses a small Docker container containing PHP and Composer to install the application's dependencies:


```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

## Configuration
1. Copy .env File
```bash
cp .env.example .env
```
2. Open .env to match the following line:
```bash
DB_HOST=172.20.0.2
DB_DATABASE=test_project
DB_USERNAME=root
```
3. Generate APP_KEY Key.
```bash
sail artisan key:generate
```
4. Clear the cache
```bash
sail artisan cache:clear
```
5. Add the alias for easy execution _(no need to write full command everytime)_
```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

## Serving Your Application

Finally, you may start Sail. To serve your project locally using Sail:

```bash
./vendor/bin/sail up
```

Once the Bash alias has been configured, you may execute Sail commands by simply typing sail. The remainder of this documentation's examples will assume that you have configured this alias:

```bash
sail up
```

## Starting & Stopping Sail

Laravel Sail's docker-compose.yml file defines a variety of Docker containers that work together to help you build Laravel applications. Each of these containers is an entry within the services configuration of your docker-compose.yml file.

Before starting Sail, you should ensure that no other web servers or databases are running on your local computer. To start all of the Docker containers defined in your application's docker-compose.yml file, you should execute the up command:

```bash
sail up
```

To start all of the Docker containers in the background, you may start Sail in "detached" mode:

```bash
sail up -d
```

To stop all of the containers, you may simply press Control + C to stop the container's execution. Or, if the containers are running in the background, you may use the stop command:

```bash
sail stop
```

## Unit Testing & Code Coverage

`This Task` deals with unit tests using [PHPUnit](https://phpunit.de/getting-started-with-phpunit.html/).

- After installing a new Laravel application, execute the `vendor/bin/phpunit` or `sail artisan test` commands to run your tests.

