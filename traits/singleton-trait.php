<?php

namespace Alexa;

/**
 * Trait Alexa|Singleton
 *
 * Should be used on all Skip Objects which are singleton;
 */
trait Singleton {
	/**
	 * @var $instance;
	 */
	protected static $instance;

	/**
	 * Singleton constructor
	 */
	final private function __construct() {
		$this->init();
	}

	/**
	 * Put all class starting stuff here
	 */
	protected function init() {}

	/**
	 * Getting instance
	 *
	 * @return $instance
	 */
	final public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static;
		}
		return static::$instance;
	}
}