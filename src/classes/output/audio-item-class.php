<?php

namespace Alexa\Output;

use Alexa\Output_Object;

/**
 * Class Directive
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Audio_Item implements Output_Object {
	/**
	 * Stream object
	 *
	 * @since 1.0.0
	 *
	 * @var Stream
	 */
	private $stream;

	/**
	 * Accessing Stream Object
	 *
	 * @since 1.0.0
	 *
	 * @return Stream
	 */
	public function stream() {
		if( empty ( $this->stream ) ) {
			$this->stream = new Stream();
		}
		return $this->stream;
	}

	/**
	 * Is there any value set in stream
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function has_values() {
		if( empty( $this->stream )) {
			return false;
		}

		return true;
	}

	/**
	 * @return \stdClass
	 */
	public function get() {
		$object = new \stdClass();

		if( $this->stream()->has_values() ) {
			$object->stream = $this->stream()->get();
		}

		return $object;
	}
}