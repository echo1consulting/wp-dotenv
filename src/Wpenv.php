<?php

namespace Wpenv;

class Wpenv extends \Dotenv\Dotenv {

    /**
     * Maps an environment variable to a constant
     * @param string $env_var_key
     * @param string $constant
		 * @param string $type
     * @return $this
     */
	public function map_constant( $env_var_key, $constant = null, $type= null ) {

      // If the constant is not set
      if( is_null( $constant ) ) {

          $constant = $env_var_key;

      }

      // Set a constant equal based on  param
      $this->define_constant( $env_var_key, $constant, $type );

      // Return
      return $this;

	}

    /**
     * Define a constant using the environment variable value
     * @param string $constant
     * @param string $env_var_key
		 * @param string $type
     */
    protected function define_constant( $env_var_key = '', $constant = '', $type = null ) {

        // If the constant is defined
        if( defined( $constant ) ) {

            // Throw a new exception
            throw new \RuntimeException(sprintf(
                'Constant (%s) previously defined.',
                $constant
            ));

        }

				// Set the environment variable value
				$env_var_val = getenv( $env_var_key );

				// If the type is not null
				if( !is_null( $type ) ) {

					// If the type is bool
					if( $type == 'bool' ) {

						// Cast to bool
						$env_var_val = ( $env_var_val === 'true' );

					}

					// Set the type
					settype( $env_var_val, $type );

				}

        // Define the constant using
        define( $constant, $env_var_val );

				// Return
        return $this;

    }

}
