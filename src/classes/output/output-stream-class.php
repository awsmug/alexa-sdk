<?php

namespace Alexa\Output;

/**
 * Class Input_Stream
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Output_Stream {
	/**
	 * Version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $version  = '1.0';

	/**
	 * Session attributes
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	private $session_attributes = array();

	/**
	 * Response Object
	 *
	 * @since 1.0.0
	 *
	 * @var Response
	 */
	protected $response;

	/**
	 * Output_Stream constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Response object
	 *
	 * @since 1.0.0
	 *
	 * @return Response
	 */
	public function response() {
		if( empty( $this->response ) ) {
			$this->response = new Response();
		}

		return $this->response;
	}

	/**
	 * Setting Response version
	 *
	 * @since 1.0.0
	 *
	 * @param string $version
	 */
	public function set_version( $version ) {
		$this->version = $version;
	}

	/**
	 * Get Response version
	 *
	 * @since 1.0.0
	 *
	 * @return string $version
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Adding a session attribute
	 *
	 * @since 1.0.0
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function add_session_attribute( $name, $value ) {
		array_push( $this->session_attributes, array( $name, $value ) );
	}

	/**
	 * Get all Session attributes
	 * @return array
	 */
	public function get_session_attributes() {
		return $this->session_attributes;
	}

	/**
	 * Get a specific Session attribute
	 *
	 * @since 1.0.0
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_session_attribute( $name ) {
		if( ! array_key_exists( $name, $this->session_attributes ) ) {
			return false;
		}
		return $this->session_attributes[ $name ];
	}
}