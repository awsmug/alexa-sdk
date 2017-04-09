<?php

namespace Alexa\Input;
use Alexa\Raw_Object;
use Alexa\Exception;

/**
 * Class Input_Stream
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Input_Stream {
	use Raw_Object;

	/**
	 * Version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $version;

	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var Session
	 */
	private $session;

	/**
	 * Context Data
	 *
	 * @since 1.0.0
	 *
	 * @var Context
	 */
	private $context;

	/**
	 * Request Data
	 *
	 * @since 1.0.0
	 *
	 * @var Request
	 */
	private $request;

	/**
	 * Request constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Input from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->version = $object->version;
	}

	/**
	 * Get Version
	 *
	 * @since 1.0.0
	 *
	 * @return Session $session
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Get Session
	 *
	 * @since 1.0.0
	 *
	 * @return Session $session
	 */
	public function session() {
		if( empty( $this->session ) ) {
			$this->session = new Session( $this->object->session );
		}

		return $this->session;
	}

	/**
	 * Is there a context object in request
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function has_context() {
		if( ! property_exists( $this->object, 'context' ) ){
            return false;
		}

		return true;
	}

	/**
	 * Get Context
	 *
	 * @since 1.0.0
	 *
	 * @return Context $context
	 *
	 * @throws Exception
	 */
	public function context() {
		if( empty( $this->context ) ) {
			if( ! property_exists( $this->object, 'context' ) ) {
				throw new Exception( 'There is no context data in this request.' );
			}

			$this->context = new Context( $this->object->context );
		}

		return $this->context;
	}

	/**
	 * Get Request
	 *
	 * @since 1.0.0
	 *
	 * @return Request $request
	 */
	public function request() {
		if( empty( $this->request ) ) {
			$this->request = new Request( $this->object->request );
		}

		return $this->request;
	}
}