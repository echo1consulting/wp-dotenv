<?php

namespace Wpenv;

class Wpenv extends \Dotenv\Dotenv {

    /**
     * Maps an environment variable to a constant
     * @param $env_var_key
     * @param string $constant
     * @return $this
     */
	public function map_constant( $env_var_key, $constant = '' ) {

		// If this is a string
		if( is_string( $env_var_key ) ) {

            // If the constant is not set
            if( $constant === '' ) {

                $constant = $env_var_key;

            }

            // Set a constant equal based on  param
            $this->define_constant( $constant, $env_var_key );

            // Return
            return $this;

		}
		// If this is an array
		if( is_array( $env_var_key ) ) {

            // For each env var param
            foreach( $env_var_key as $_env_var_key => $constant ) {

                // If this is an indexed array element
                if( is_int( $_env_var_key ) ) {

                    $_env_var_key = $constant;

                }

                // Set a constant equal based on  constant param
                $this->define_constant( $constant, $_env_var_key );

            }

		}

		return $this;

	}

    /**
     * Define a constant using the environment variable value
     * @param string $constant
     * @param string $env_var_key
     */
    public function define_constant( $constant = '', $env_var_key = '' ) {

        // If the constant is defined
        if( defined( $constant ) ) {

            // Throw a new exception
            throw new \RuntimeException(sprintf(
                'Constant (%s) previously defined.',
                $constant
            ));

        }

        // Define the constant using
        define( $constant, getenv( $env_var_key ) );

        return $this;

    }

}