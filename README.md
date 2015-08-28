WP dotenv
==========

Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.

This is an extension of the popular [PHP dotenv](https://github.com/vlucas/phpdotenv), but extended to map environment variables to constants for Wordpress configurations.


Installation with Composer
--------------------------

**Clone this repository into your Wordpress root by executing:**

```git clone https://github.com/echo1consulting/wp-dotenv.git```

**Change your working directory to the wp-dotenv folder and execute:**

`composer install`

**At the top of your wp-config.php file, add the following:**

```php
// Includes the wp-dotenv bootstrap file
require_once( __DIR__ . '/wp-dotenv/bootstrap/autoload.php');

// Initializes the wp-env class
$wp_env = new \Wpenv\Wpenv( __DIR__ );

// Loads the environment variables
$wp_env->load();

// Sets up required environment variables
$wp_env->required( ['DB_HOST','DB_NAME', 'DB_USER', 'DB_PASSWORD'] );

// Maps environment variables to constants with the same name
$wp_env->map_constant( ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD'] );

```

Update the environment variables on your system, or place a .env file with the environment variables in your Wordpress root. An example .env.example file can be found in the wp-env folder.


Advanced Mapping
--------------------------
You can map your environment variables to constants. See the following examples:

```php
/**
 * Map the environment variable to a constant with the same name
 * e.g. Maps $_ENV['DB_HOST'] to DB_HOST
 */

$wp_env->map_constant( 'DB_HOST' );
$wp_env->map_constant( 'DB_NAME' );
$wp_env->map_constant( 'DB_USER' );
$wp_env->map_constant( 'DB_PASSWORD' );


/**
 * Map the environment variable to a constant with a custom name
 * e.g. Maps $_ENV['DB_HOST'] to DATABASE_NAME
 */

$wp_env->map_constant( 'DB_NAME', 'DATABASE_NAME' );


/**
 * Map an array of environment variables to constants with the same name
 * e.g. Maps $_ENV['DB_HOST'] to DB_HOST
 */

$wp_env->map_constant( ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD'] );


/**
 * Map an array of environment variables to constants with custom names
 * e.g. Maps $_ENV['DB_HOST'] to DATABASE_NAME
 */

$wp_env->map_constant( ['DB_HOST' => 'DATABASE_HOST', 'DB_NAME' => 'DATABASE_NAME', 'DB_USER' => 'DATABASE_USER', 'DB_PASSWORD' => 'DATABASE_PASSWORD'] );
```