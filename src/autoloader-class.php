<?php

namespace Alexa;

/**
 * Class Skip_Autoloader
 *
 * @since 1.0.0
 *
 * @package Skip
 */
class Autoloader {
	/**
	 * Path to library
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected static $dir;

	/**
	 * Initializing Autoloader
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		self::$dir = dirname( __FILE__ );
		spl_autoload_register( array( __CLASS__ , 'autoload' ) );
	}

	/**
	 * Autoloader function
	 *
	 * @since 1.0.0
	 *
	 * @param string $class_name
	 *
	 * @return bool
	 */
	public static function autoload( $class_name ) {
		$parts = explode( '\\', $class_name );

		// Main directory
		$sdk_dir = dirname( __FILE__ );

		// Possible subdirectories in main directory
		$possible_types = array(
			'/classes' => '-class.php',
			'/traits' => '-trait.php',
			'/interfaces'  => '-interface.php',
		);

		// Getting Component directory
		$component_part = '';
		$part_number = 0;
		foreach( $parts AS $part ) {
			if( 'Alexa' === $part ) {
				continue;
			}

			if( $part_number < count( $parts ) ) {
				$component_part .= '/' . str_replace( '_', '-', strtolower( $part ) );
			}
		}

		foreach ( $possible_types AS $dir => $suffix ) {
			$possible_directory = $sdk_dir . $dir;
			$possible_file = $possible_directory . $component_part . $suffix;

			if( file_exists( $possible_file ) ) {
				require_once $possible_file;
				return true;
			}
		}

		return false;
	}
}