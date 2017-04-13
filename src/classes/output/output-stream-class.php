<?php

namespace Alexa\Output;
use Alexa\Output_Object;

/**
 * Class Input_Stream
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Output_Stream implements Output_Object {
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
	public function __construct() {}

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
		$this->session_attributes[ $name ] = $value;
	}

	/**
	 * Get all Session attributes
	 *
	 * @since 1.0.0
	 *
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

	/**
	 * Get Session attribute Object for Response to Alexa
	 *
	 * @since 1.0.0
	 *
	 * @return \stdClass
	 */
	private function get_session_attributes_obj() {
		$session_attributes = new \stdClass();

		foreach( $this->get_session_attributes() AS $key => $value ) {
			$session_attributes->$key = $value;
		}

		return $session_attributes;
	}

	/**
	 * Get Output Object for Alexa
	 *
	 * @since 1.0.0
	 *
	 * @return \StdClass
	 */
	public function get() {
		$object = new \StdClass;

		$object->version = $this->version;

		$object->response = $this->response()->get();

		$object->sessionAttributes = $this->get_session_attributes_obj();

		return $object;
	}

	/**
	 * Getting Output Object for alexa as json string
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_json() {
		return json_encode( $this->get() );
	}
}