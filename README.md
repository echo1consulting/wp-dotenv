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

Advanced Mapping
--------------------------
Update the environment variables on your system, or place a .env file with the environment variables in your Wordpress root. An example .env.example file can be found in the wp-dotenv folder. You can map your environment variables to constants. See the following examples:

```php
// Includes the wp-dotenv bootstrap file
require_once( __DIR__ . '/wp-dotenv/bootstrap/autoload.php');

// Initializes the wp-dotenv class
$wp_env = new \Wpenv\Wpenv( __DIR__ );

// Loads the environment variables
$wp_env->load();

// Sets up required environment variables
$wp_env->required( ['DB_HOST','DB_NAME', 'DB_USER', 'DB_PASSWORD'] );

// Maps environment variables to constants with the same name
$wp_env->map_constant( 'DB_HOST' );
$wp_env->map_constant( 'DB_NAME' );
$wp_env->map_constant( 'DB_USER' );
$wp_env->map_constant( 'DB_PASSWORD' );

$wp_env->map_constant( 'DB_CHARSET' );
$wp_env->map_constant( 'DB_COLLATE' );

$wp_env->map_constant( 'AUTH_KEY' );
$wp_env->map_constant( 'SECURE_AUTH_KEY' );
$wp_env->map_constant( 'LOGGED_IN_KEY' );
$wp_env->map_constant( 'NONCE_KEY' );
$wp_env->map_constant( 'AUTH_SALT' );
$wp_env->map_constant( 'SECURE_AUTH_SALT' );
$wp_env->map_constant( 'LOGGED_IN_SALT' );
$wp_env->map_constant( 'NONCE_SALT' );

$wp_env->map_constant( 'WP_DEBUG', 'WP_DEBUG', 'bool' );
$wp_env->map_constant( 'WP_DEBUG_DISPLAY', 'WP_DEBUG_DISPLAY', 'bool' );
```
