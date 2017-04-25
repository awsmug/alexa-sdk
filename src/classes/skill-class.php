<?php

namespace Alexa;
use Alexa\Input\Input_Stream;
use Alexa\Output\Output_Stream;

/**
 * Class Skill
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
abstract class Skill {
    /**
     * Logging functionality
     *
     * @since 1.0.0
     */
    use Logger;

	/**
	 * Application ID
	 *
	 * @var string
	 */
	private $application_id;

	/**
	 * Raw input data from Alexa as JSON String
	 *
	 * @since 1.0.0
	 *
	 * @var Input\Input_Stream
	 */
	private $input;

	/**
	 * Output data for Alexa
	 *
	 * @since 1.0.0
	 *
	 * @var Output\Output_Stream
	 */
	private $output;

	/**
	 * Skill constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $application_id Skill Application ID
	 */
	public function __construct( $application_id ) {
		$this->application_id = $application_id;
	}

	/**
	 * Getting Data from Alexa
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $input
	 *
	 * @return Input_Stream
	 *
	 * @throws Exception
	 */
	public function input( $input = null ) {
		if( ! empty( $input ) ){
			$this->input = new Input_Stream( $input );
		}

		if( empty( $this->input ) ) {
			$this->input = new Input_Stream( $this->receive() );
		}

		if( ! $this->input->session()->application()->id_equals( $this->application_id ) ) {
			throw new Exception( 'Wrong Application ID' );
		}

		return $this->input;
	}

	/**
	 * Outputting data to Alexa
	 *
	 * @since 1.0.0
	 *
	 * @return Output_Stream $output
	 */
	public function output() {
		if( empty( $this->output ) ) {
			$this->output = new Output_Stream();
		}

		return $this->output;
	}

	/**
	 * Getting input from Alexa
	 *
	 * @since 1.0.0
	 *
	 * @return \StdClass
	 *
	 * @throws Exception
	 */
	private function receive() {
		$input = file_get_contents( 'php://input' );

		if( empty( $input ) ) {
			throw new Exception( 'No input from Alexa' );
		}

		$this->input = json_decode( $input );

        $this->log( $this->input );

		return $this->input;
	}

	/**
	 * Preparing data for output to Alexa
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $response
	 */
	public function send( $response ) {
		$response = json_encode( $response );
		$size = strlen ( $response );

		header( 'Content-Type: application/json' );
		header( 'Content-length: ' . $size );

		echo $response;
	}
}