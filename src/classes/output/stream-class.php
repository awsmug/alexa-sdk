<?php

namespace Alexa\Output;

use Alexa\Output_Object;

/**
 * Class Stream
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Stream implements Output_Object {
	/**
	 * Url
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $url;

	/**
	 * Tokenoken
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $token;

	/**
	 * Expected previous token
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $previous_token;

	/**
	 * Offset in milliseconds
	 *
	 * @since 1.0.0
	 *
	 * @var int
	 */
	private $offset = 0;

	/**
	 * Setting URL
	 *
	 * @since 1.0.0
	 *
	 * @param string $version
	 */
	public function set_url( $url ) {
		$this->url = $url;
	}

	/**
	 * Get URL
	 *
	 * @since 1.0.0
	 *
	 * @return string $url
	 */
	public function get_url() {
		return $this->url;
	}

	/**
	 * Setting Token
	 *
	 * @since 1.0.0
	 *
	 * @param string $token
	 */
	public function set_token( $token ) {
		$this->token = $token;
	}

	/**
	 * Get Token
	 *
	 * @since 1.0.0
	 *
	 * @return string $token
	 */
	public function get_token() {
		return $this->token;
	}

	/**
	 * Setting Offset in miliseconds
	 *
	 * @since 1.0.0
	 *
	 * @param int $offset
	 */
	public function set_offset( $offset ) {
		$this->offset = $offset;
	}

	/**
	 * Get Offset
	 *
	 * @since 1.0.0
	 *
	 * @return int $offset
	 */
	public function get_offset() {
		return $this->offset;
	}

	/**
	 * Setting Expected Previous Token
	 *
	 * @since 1.0.0
	 *
	 * @param string $previous_token
	 */
	public function set_previous_token( $previous_token ) {
		$this->previous_token = $previous_token;
	}

	/**
	 * Get Expected Previous Token
	 *
	 * @since 1.0.0
	 *
	 * @return string $previous_token
	 */
	public function get_previous_token() {
		return $this->previous_token;
	}

	/**
	 * Is there any value set in stream
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function has_values() {
		if( empty( $this->url )) {
			return false;
		}

		return true;
	}

	/**
	 * Get Output Object for Alexa
	 *
	 * @since 1.0.0
	 *
	 * @return \StdClass
	 */
	public function get() {
		$object = new \stdClass();

		if( ! empty( $this->url ) ) {
			$object->url = $this->url;
		}

		if( ! empty( $this->token ) ) {
			$object->token = $this->token;
		} else {
            $object->token = basename( $this->url );
        }

		if( ! empty( $this->previous_token ) ) {
			$object->expectedPreviousToken = $this->previous_token;
		}

		$object->offsetInMilliseconds = $this->offset;

		return $object;
	}
}