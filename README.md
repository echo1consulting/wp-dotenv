WP dotenv
==========

Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.

This is an extension of the popular [PHP dotenv](https://github.com/vlucas/phpdotenv) for Wordpress.


Installation with Composer
--------------------------

1. Clone this repository into your Wordpress root.
```git clone https://github.com/echo1consulting/wp-env.git```

2. Change directory into the wp-env folder and execute `composer install`

3. At the top of your wp-config.php add the following:

```php

// Include the wp-env bootstrap file
require_once( __DIR__ . '/wp-env/bootstrap.php');

// Initialize the env class
$wp_env = new \Wpenv\Wpenv( __DIR__ );

// Load the .env in your application
$wp_env->load();

// Set your apps required fields
$wp_env->required( ['DB_HOST','DB_NAME', 'DB_USER', 'DB_PASSWORD'] );

```



Usage
-----
The `.env` file is generally kept out of version control since it can contain
sensitive API keys and passwords. A separate `.env.example` file is created
with all the required environment variables defined except for the sensitive
ones, which are either user-supplied for their own development environments or
are communicated elsewhere to project collaborators. The project collaborators
then independently copy the `.env.example` file to a local `.env` and ensure
all the settings are correct for their local environment, filling in the secret
keys or providing their own values when necessary. In this usage, the `.env`
file should be added to the project's `.gitignore` file so that it will never
be committed by collaborators.  This usage ensures that no sensitive passwords
or API keys will ever be in the version control history so there is less risk
of a security breach, and production values will never have to be shared with
all project collaborators.

Add your application configuration to a `.env` file in the root of your
project. **Make sure the `.env` file is added to your `.gitignore` so it is not
checked-in the code**

```shell
S3_BUCKET="dotenv"
SECRET_KEY="souper_seekret_key"
```

Now create a file named `.env.example` and check this into the project. This
should have the ENV variables you need to have set, but the values should
either be blank or filled with dummy data. The idea is to let people know what
variables are required, but not give them the sensitive production values.

```shell
S3_BUCKET="devbucket"
SECRET_KEY="abc123"
```

You can then load `.env` in your application with:

```php
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
```

All of the defined variables are now accessible with the `getenv`
method, and are available in the `$_ENV` and `$_SERVER` super-globals.

```php
$s3_bucket = getenv('S3_BUCKET');
$s3_bucket = $_ENV['S3_BUCKET'];
$s3_bucket = $_SERVER['S3_BUCKET'];
```

You should also be able to access them using your framework's Request
class (if you are using a framework).

```php
$s3_bucket = $request->env('S3_BUCKET');
$s3_bucket = $request->getEnv('S3_BUCKET');
$s3_bucket = $request->server->get('S3_BUCKET');
$s3_bucket = env('S3_BUCKET');
```

### Nesting Variables

It's possible to nest an environment variable within another, useful to cut
down on repetition.

This is done by wrapping an existing environment variable in `${…}` e.g.

```shell
BASE_DIR="/var/webroot/project-root"
CACHE_DIR="${BASE_DIR}/cache"
TMP_DIR="${BASE_DIR}/tmp"
```

### Immutability

By default, Dotenv will NOT overwrite existing environment variables that are
already set in the environment.

If you want Dotenv to overwrite existing environment variables, use `overload`
instead of `load`:

```php
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->overload();
```

Requiring Variables to be Set
-----------------------------

Using Dotenv, you can require specific ENV vars to be defined, and throw
an Exception if they are not. This is particularly useful to let people know
any explicit required variables that your app will not work without.

You can use a single string:

```php
$dotenv->required('DATABASE_DSN');
```

Or an array of strings:

```php
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);
```

If any ENV vars are missing, Dotenv will throw a `RuntimeException` like this:

```
One or more environment variables failed assertions: DATABASE_DSN is missing
```