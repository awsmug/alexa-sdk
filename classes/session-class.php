<?php

namespace Alexa;

/**
 * Class Session
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Session {
	use Id;
	use Raw_Object;

	/**
	 * Is Session new
	 *
	 * @since 1.0.0
	 *
	 * @var bool
	 */
	protected $new;

	/**
	 * Attributes array
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected $attributes = array();

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
	 * Session constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Session from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->id = $object->sessionId;

		$this->new = $object->new;
	}

	/**
	 * Getting all Attributes
	 *
	 * @since 1.0.0
	 *
	 * @return array|bool
	 */
	public function get_attributes() {
		if ( empty( $this->attributes ) ) {
			if ( property_exists( $this->object, 'attributes') ) {
				$attributes = get_object_vars( $this->object->attributes );

				if( empty( $attributes ) ) {
					return false;
				}

				$this->attributes = $attributes;
			}
		}

		return $this->attributes;
	}

	/**
	 * Getting Attribute Value
	 *
	 * @since 1.0.0
	 *
	 * @param string $name
	 *
	 * @return string $value
	 */
	public function get_attribute( $name ) {
		if ( empty( $this->get_attributes() ) ) {
			return false;
		}

		if( ! array_key_exists( $name, $this->attributes ) ) {
			return false;
		}

		return $this->attributes;
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
}