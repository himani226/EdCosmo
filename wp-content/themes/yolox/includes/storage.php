<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) {
	exit; }

// Get theme variable
if ( ! function_exists( 'yolox_storage_get' ) ) {
	function yolox_storage_get( $var_name, $default = '' ) {
		global $YOLOX_STORAGE;
		return isset( $YOLOX_STORAGE[ $var_name ] ) ? $YOLOX_STORAGE[ $var_name ] : $default;
	}
}

// Set theme variable
if ( ! function_exists( 'yolox_storage_set' ) ) {
	function yolox_storage_set( $var_name, $value ) {
		global $YOLOX_STORAGE;
		$YOLOX_STORAGE[ $var_name ] = $value;
	}
}

// Check if theme variable is empty
if ( ! function_exists( 'yolox_storage_empty' ) ) {
	function yolox_storage_empty( $var_name, $key = '', $key2 = '' ) {
		global $YOLOX_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return empty( $YOLOX_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return empty( $YOLOX_STORAGE[ $var_name ][ $key ] );
		} else {
			return empty( $YOLOX_STORAGE[ $var_name ] );
		}
	}
}

// Check if theme variable is set
if ( ! function_exists( 'yolox_storage_isset' ) ) {
	function yolox_storage_isset( $var_name, $key = '', $key2 = '' ) {
		global $YOLOX_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return isset( $YOLOX_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return isset( $YOLOX_STORAGE[ $var_name ][ $key ] );
		} else {
			return isset( $YOLOX_STORAGE[ $var_name ] );
		}
	}
}

// Inc/Dec theme variable with specified value
if ( ! function_exists( 'yolox_storage_inc' ) ) {
	function yolox_storage_inc( $var_name, $value = 1 ) {
		global $YOLOX_STORAGE;
		if ( empty( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = 0;
		}
		$YOLOX_STORAGE[ $var_name ] += $value;
	}
}

// Concatenate theme variable with specified value
if ( ! function_exists( 'yolox_storage_concat' ) ) {
	function yolox_storage_concat( $var_name, $value ) {
		global $YOLOX_STORAGE;
		if ( empty( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = '';
		}
		$YOLOX_STORAGE[ $var_name ] .= $value;
	}
}

// Get array (one or two dim) element
if ( ! function_exists( 'yolox_storage_get_array' ) ) {
	function yolox_storage_get_array( $var_name, $key, $key2 = '', $default = '' ) {
		global $YOLOX_STORAGE;
		if ( empty( $key2 ) ) {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $YOLOX_STORAGE[ $var_name ][ $key ] ) ? $YOLOX_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $YOLOX_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $YOLOX_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if ( ! function_exists( 'yolox_storage_set_array' ) ) {
	function yolox_storage_set_array( $var_name, $key, $value ) {
		global $YOLOX_STORAGE;
		if ( ! isset( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$YOLOX_STORAGE[ $var_name ][] = $value;
		} else {
			$YOLOX_STORAGE[ $var_name ][ $key ] = $value;
		}
	}
}

// Set two-dim array element
if ( ! function_exists( 'yolox_storage_set_array2' ) ) {
	function yolox_storage_set_array2( $var_name, $key, $key2, $value ) {
		global $YOLOX_STORAGE;
		if ( ! isset( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = array();
		}
		if ( ! isset( $YOLOX_STORAGE[ $var_name ][ $key ] ) ) {
			$YOLOX_STORAGE[ $var_name ][ $key ] = array();
		}
		if ( '' === $key2 ) {
			$YOLOX_STORAGE[ $var_name ][ $key ][] = $value;
		} else {
			$YOLOX_STORAGE[ $var_name ][ $key ][ $key2 ] = $value;
		}
	}
}

// Merge array elements
if ( ! function_exists( 'yolox_storage_merge_array' ) ) {
	function yolox_storage_merge_array( $var_name, $key, $value ) {
		global $YOLOX_STORAGE;
		if ( ! isset( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$YOLOX_STORAGE[ $var_name ] = array_merge( $YOLOX_STORAGE[ $var_name ], $value );
		} else {
			$YOLOX_STORAGE[ $var_name ][ $key ] = array_merge( $YOLOX_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Add array element after the key
if ( ! function_exists( 'yolox_storage_set_array_after' ) ) {
	function yolox_storage_set_array_after( $var_name, $after, $key, $value = '' ) {
		global $YOLOX_STORAGE;
		if ( ! isset( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			yolox_array_insert_after( $YOLOX_STORAGE[ $var_name ], $after, $key );
		} else {
			yolox_array_insert_after( $YOLOX_STORAGE[ $var_name ], $after, array( $key => $value ) );
		}
	}
}

// Add array element before the key
if ( ! function_exists( 'yolox_storage_set_array_before' ) ) {
	function yolox_storage_set_array_before( $var_name, $before, $key, $value = '' ) {
		global $YOLOX_STORAGE;
		if ( ! isset( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			yolox_array_insert_before( $YOLOX_STORAGE[ $var_name ], $before, $key );
		} else {
			yolox_array_insert_before( $YOLOX_STORAGE[ $var_name ], $before, array( $key => $value ) );
		}
	}
}

// Push element into array
if ( ! function_exists( 'yolox_storage_push_array' ) ) {
	function yolox_storage_push_array( $var_name, $key, $value ) {
		global $YOLOX_STORAGE;
		if ( ! isset( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			array_push( $YOLOX_STORAGE[ $var_name ], $value );
		} else {
			if ( ! isset( $YOLOX_STORAGE[ $var_name ][ $key ] ) ) {
				$YOLOX_STORAGE[ $var_name ][ $key ] = array();
			}
			array_push( $YOLOX_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Pop element from array
if ( ! function_exists( 'yolox_storage_pop_array' ) ) {
	function yolox_storage_pop_array( $var_name, $key = '', $defa = '' ) {
		global $YOLOX_STORAGE;
		$rez = $defa;
		if ( '' === $key ) {
			if ( isset( $YOLOX_STORAGE[ $var_name ] ) && is_array( $YOLOX_STORAGE[ $var_name ] ) && count( $YOLOX_STORAGE[ $var_name ] ) > 0 ) {
				$rez = array_pop( $YOLOX_STORAGE[ $var_name ] );
			}
		} else {
			if ( isset( $YOLOX_STORAGE[ $var_name ][ $key ] ) && is_array( $YOLOX_STORAGE[ $var_name ][ $key ] ) && count( $YOLOX_STORAGE[ $var_name ][ $key ] ) > 0 ) {
				$rez = array_pop( $YOLOX_STORAGE[ $var_name ][ $key ] );
			}
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if ( ! function_exists( 'yolox_storage_inc_array' ) ) {
	function yolox_storage_inc_array( $var_name, $key, $value = 1 ) {
		global $YOLOX_STORAGE;
		if ( ! isset( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = array();
		}
		if ( empty( $YOLOX_STORAGE[ $var_name ][ $key ] ) ) {
			$YOLOX_STORAGE[ $var_name ][ $key ] = 0;
		}
		$YOLOX_STORAGE[ $var_name ][ $key ] += $value;
	}
}

// Concatenate array element with specified value
if ( ! function_exists( 'yolox_storage_concat_array' ) ) {
	function yolox_storage_concat_array( $var_name, $key, $value ) {
		global $YOLOX_STORAGE;
		if ( ! isset( $YOLOX_STORAGE[ $var_name ] ) ) {
			$YOLOX_STORAGE[ $var_name ] = array();
		}
		if ( empty( $YOLOX_STORAGE[ $var_name ][ $key ] ) ) {
			$YOLOX_STORAGE[ $var_name ][ $key ] = '';
		}
		$YOLOX_STORAGE[ $var_name ][ $key ] .= $value;
	}
}

// Call object's method
if ( ! function_exists( 'yolox_storage_call_obj_method' ) ) {
	function yolox_storage_call_obj_method( $var_name, $method, $param = null ) {
		global $YOLOX_STORAGE;
		if ( null === $param ) {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $YOLOX_STORAGE[ $var_name ] ) ? $YOLOX_STORAGE[ $var_name ]->$method() : '';
		} else {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $YOLOX_STORAGE[ $var_name ] ) ? $YOLOX_STORAGE[ $var_name ]->$method( $param ) : '';
		}
	}
}

// Get object's property
if ( ! function_exists( 'yolox_storage_get_obj_property' ) ) {
	function yolox_storage_get_obj_property( $var_name, $prop, $default = '' ) {
		global $YOLOX_STORAGE;
		return ! empty( $var_name ) && ! empty( $prop ) && isset( $YOLOX_STORAGE[ $var_name ]->$prop ) ? $YOLOX_STORAGE[ $var_name ]->$prop : $default;
	}
}
