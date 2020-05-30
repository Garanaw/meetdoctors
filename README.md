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
./dev.sh install
```

This will run some commands that Laravel require to function properly, such as key generation, migrations, storage linking and the creation of the testing user.

The next step is to build the application. in order to do that, you should run the following command:

```
./dev.sh build
```

This command will install the composer and node packages and will compile the last ones.
