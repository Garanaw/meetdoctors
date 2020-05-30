# User Report Generator

## Requirements:

To run this application, you need to have installed the below in your system:

* PHP 7.3+
* Mysql
* Apache, NginX or other server
* Composer
* Nodejs
* Npm

## Installation:

To install the application, you can either do it with Git or copying the files to your server:

### Using Git:

```
git clone https://github.com/Garanaw/meetdoctors.git
```

### Next steps:

Once the project is cloned/copied, you will need to run a few commands to get it ready:

To generate the `.env` file, run the next command:

```
./dev.sh env
```

It will copy the example environment file, which you will need to fill with your own configuration. There are a few variables that will be required:

The database variables:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

The mail variables. In the `ADMIN_EMAIL` you should configure a email account that you have access to, as it will be used as recipient for the reports.

```
MAIL_MAILER=smtp
MAIL_DRIVER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"
ADMIN_EMAIL=
```

The testing variables. This will be used to generate a testing user.

```
TEST_USER=
TEST_EMAIL=
TEST_PASSWORD=
```

Once all is configured, you should run the next command:

```
./dev.sh build
```

This command will install the composer and node packages and will compile the last ones. After this, the last thing to do is to set the right permissions to the storage folder. From the application directory, run the next command:

```
./dev.sh install
```

This will run some commands that Laravel require to function properly, such as key generation, migrations, storage linking and the creation of the testing user.

The next step is to build the application. In order to do that, you should run the following command:

```
sudo chmod -R 777 storage
```

With all this done, we are ready to use it.

## Usage:

The first thing is to upload the users file. To do this, log in with the generated user, and go in your browser to:

```
http://my-application.test/home
```

A form will be shown with a single file input. It will only accept XML files with the provided format. This step can be skipped, but it will be needed to fully test the application.

Then, from a console, you can run the command:

```
php artisan users:read
```

This will read the users from all the files uploaded, and also from the URL provided (jsonplaceholder for the tests), and generate a report with them, that will be shown in the console. If the command is run with a cron, this report will not be seen. However, in any case, a CSV file will be generated under the folder `storage/app/reports` and will be sent to the email address specified in the environment variable `ADMIN_EMAIL`.

## Testing:

To run the tests, you can use PHPUnit framework or artisan-

### With PHPUnit

```
vendor/bin/phpunit
```

### With Artisan:

```
php artisan test
```

## Caveats:

The devops technique is designed to run under Unix architectures. That means, if you are using the application in a Windows system, the previous commands will not work as expected, and you will need to install it manually. To do that:

* Copy the .env.example file to .env
* Set your environment config
* Run `composer install`
* Run `npm install`
* Run `npm run prod`
* Run `php artisan key:generate`
* Run `php artisan migrate:install`
* Run `php artisan migrate --step`
* Run `php artisan storage:link`
* Run `php artisan make:user:test`

With all this, you will be ready to go.
