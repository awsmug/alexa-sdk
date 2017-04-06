<?php

namespace Alexa;

/**
 * Class Request
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Request {
	use Raw_Object;

	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * Request ID
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $request_id;

	/**
	 * Timestamp
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $timestamp;

	/**
	 * Locale
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $locale;

	/**
	 * Intent Data
	 *
	 * @since 1.0.0
	 *
	 * @var Intent
	 */
	protected $intent;

	/**
	 * Request constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Input from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->request_id = $object->requestId;
		$this->type = $object->type;
		$this->locale = $object->locale;
		$this->timestamp = $object->timestamp;
	}

	/**
	 * Get Request Type
	 *
	 * @since 1.0.0
	 *
	 * @return string $type
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Get Request ID
	 *
	 * @since 1.0.0
	 *
	 * @return string $request_id
	 */
	public function get_id() {
		return $this->request_id;
	}

	/**
	 * Get Locale
	 *
	 * @since 1.0.0
	 *
	 * @return string $locale
	 */
	public function get_locale() {
		return $this->locale;
	}

	/**
	 * Get Timestamp
	 *
	 * @since 1.0.0
	 *
	 * @return string $timestamp
	 */
	public function get_timestamp() {
		return $this->timestamp;
	}

	/**
	 * Get intent
	 *
	 * @since 1.0.0
	 *
	 * @return Intent $intent
	 *
	 * @throws Exception
	 */
	public function intent() {
		if( 'IntentRequest' !== $this->type ) {
			throw new Exception( 'Intent is not existing in this request' );
		}

		if( empty( $this->intent ) ) {
			$this->intent = new Intent( $this->object->intent );
		}

		return $this->intent;
	}

	/**
	 * Checks if Request has an Intent
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	public function has_intent() {
		return 'IntentRequest' === $this->type ? true : false;
	}
}