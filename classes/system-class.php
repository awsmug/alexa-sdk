<?php

namespace Alexa;

/**
 * Class System
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class System{
	use Raw_Object;

	/**
	 * API Endpoint
	 *
	 * @since 1.0.0
	 *
	 * @var string|bool
	 */
	protected $api_endpoint = false;

	/**
	 * Application Object
	 *
	 * @since 1.0.0
	 *
	 * @var Application
	 */
	protected $application;

	/**
	 * User Object
	 *
	 * @since 1.0.0
	 *
	 * @var User
	 */
	protected $user;

	/**
	 * System constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $system_data Session from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		if( property_exists( $object, 'api_endpoint' ) ) {
			$this->api_endpoint = $object->api_endpoint;
		}
	}

	/**
	 * Returns Application Object
	 *
	 * @since 1.0.0
	 *
	 * @return Application $application
	 */
	public function application() {
		if( empty( $this->application ) ) {
			$this->application = new Application( $this->object->application );
		}
		return $this->application;
	}

	/**
	 * Returns User Object
	 *
	 * @since 1.0.0
	 *
	 * @return User $user
	 */
	public function user() {
		if( empty( $this->user ) ) {
			$this->user = new User( $this->object->user );
		}

		return $this->user;
	}

	/**
	 * Get API endpoint
	 *
	 * @since 1.0.0
	 *
	 * @return string|bool
	 */
	public function get_api_endpoint() {
		return $this->api_endpoint;
	}
}