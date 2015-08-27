WP dotenv
==========

Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.

This is an extension of the popular [PHP dotenv](https://github.com/vlucas/phpdotenv), but extended to map environment variables to constants for Wordpress configurations.


Installation with Composer
--------------------------

1. Clone this repository into your Wordpress root.

```git clone https://github.com/echo1consulting/wp-env.git```

2. Change directory to the wp-env folder and execute `composer install`

3. At the top of your wp-config.php add the following:

```php
// Include the wp-env bootstrap file
require_once( __DIR__ . '/wp-env/bootstrap.php');

// Initialize the wp-env class
$wp_env = new \Wpenv\Wpenv( __DIR__ );

// Load the environment variables to your app
$wp_env->load();

// Set your any required environment variables
$wp_env->required( ['DB_HOST','DB_NAME', 'DB_USER', 'DB_PASSWORD'] );

// Map environment variables to constants with the same name
$wp_env->map_constant( ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD'] );

```

4. Update the environment variables on your system, or place a .env file with the environment variables in your Wordpress root. An example .env.example file can be found in the wp-env folder.