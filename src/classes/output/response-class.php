<?php

namespace Alexa\Output;
use Alexa\Output_Object;

/**
 * Class Response
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Response implements Output_Object {
	/**
	 * Output Speech
	 *
	 * @since 1.0.0
	 *
	 * @var Output_Speech
	 */
	private $output_speech;

	/**
	 * Card
	 *
	 * @since 1.0.0
	 *
	 * @var Card
	 */
	private $card;

	/**
	 * Reprompt
	 *
	 * @since 1.0.0
	 *
	 * @var Reprompt
	 */
	private $reprompt;

	/**
	 * End session
	 *
	 * @since 1.0.0
	 *
	 * @var bool
	 */
	private $end_session = false;

	/**
	 * Directives
	 *
	 * @since 1.0.0
	 *
	 * @var Directive[]
	 */
	private $directives = array();

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
	 * Accessing Card Object
	 *
	 * @since 1.0.0
	 *
	 * @return Card
	 */
	public function card() {
		if( empty ( $this->card ) ) {
			$this->card = new Card();
		}
		return $this->card;
	}

	/**
	 * Accessing Output Speech Object
	 *
	 * @since 1.0.0
	 *
	 * @return Reprompt
	 */
	public function reprompt() {
		if( empty ( $this->reprompt ) ) {
			$this->reprompt = new Reprompt();
		}
		return $this->reprompt;
	}

	/**
	 * Should end Session
	 *
	 * @since 1.0.0
	 *
	 * @param bool $end
	 */
	public function end_session( $end = true ) {
		$this->end_session = $end;
	}

	/**
	 * Adding a Directive object (Audio etc.)
	 *
	 * @since 1.0.0
	 *
	 * @param Directive $directive
	 */
	public function add_directive( $directive ) {
		$this->directives[] = $directive;
	}

	/**
	 * Returns all directives
	 *
	 * @since 1.0.0
	 *
	 * @return Directive[]
	 */
	public function get_directives() {
		return $this->directives;
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

		if( $this->output_speech()->has_values() ) {
			$object->outputSpeech = $this->output_speech()->get();
		}

		if( $this->card()->has_values() ) {
			$object->card = $this->card()->get();
		}

		if( $this->reprompt()->has_values() ) {
			$object->reprompt = $this->reprompt()->get();
		}

		if( count( $this->get_directives() ) > 0 ) {
			$directives = $this->get_directives();

			foreach( $directives AS $directive ) {
				$object->directives[] = $directive->get();
			}
		}

		$object->shouldEndSession = $this->end_session;

		return $object;
	}
}