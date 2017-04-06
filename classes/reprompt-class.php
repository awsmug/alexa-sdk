<?php

namespace Alexa;

/**
 * Class Reprompt
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Reprompt{
	/**
	 * Output speech
	 *
	 * @since 1.0.0
	 *
	 * @var Output_Speech
	 */
	private $output_speech;

	/**
	 * Output_Speech constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {}

	/**
	 * Accessing Output Speech Object
	 *
	 * @since 1.0.0
	 *
	 * @return Output_Speech
	 */
	public function output_speech() {
		if( empty ( $this->output_speech ) ) {
			$this->output_speech = new Output_Speech();
		}
		return $this->output_speech;
	}

	/**
	 * Is there any value set in Output_Speech
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function has_values() {
		if( empty( $this->output_speech )) {
			return false;
		}

		return true;
	}

	/**
	 * Getting Object content
	 *
	 * @since 1.0.0
	 *
	 * @return \StdClass $object
	 */
	public function get() {
		$object = new \StdClass;

		$object->outputSpeech = $this->output_speech->get();

		return $object;
	}
}