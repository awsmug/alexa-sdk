<?php

namespace Alexa;

/**
 * Class Permissuins
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Permissions {
	use Raw_Object;

	/**
	 * Consent token
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $consent_token = false;

	/**
	 * Permissions constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Permission data from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		if( property_exists( $object, 'consent_token' ) ) {
			$this->consent_token = $object->consent_token;
		}
	}

	/**
	 * Get consent token
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_consent_token() {
		return $this->consent_token;
	}
}