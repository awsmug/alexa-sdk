<?php

namespace Alexa;

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
	 * Rare input data from Alexa as JSON String
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $input;

	/**
	 * Text which Alexa says if the skill starts
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $text_launch = 'Hello! I am an Alexa Skill.';

	/**
	 * Text which Alexa says if the skill ends
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $text_end = 'Good bye!';

	/**
	 * Text which Alexa says if she did not understood
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $text_dont_understood = 'I did not understood you.';

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
	 * Running the Skill
	 *
	 * @since 1.0.0
	 */
	public function run() {
		$this->input();
		$this->output();
	}

	/**
	 * Getting Data from Alexa
	 *
	 * @since 1.0.0
	 *
	 * @return Input
	 *
	 * @throws Exception
	 */
	public function input() {
		$this->input = new Input( $this->receive() );

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
	 * @var bool $echo True if data should be outputted direct
	 *
	 * @return array $response
	 */
	public function output( $echo = true ) {
		switch ( $this->input()->request()->get_type() ) {
			case "LaunchRequest":
				$response = $this->response_launch();
				break;
			case "SessionEndedRequest":
				$response = $this->response_end();
				break;
			case "IntentRequest":
				$response = $this->interact( $this->input()->request()->intent() );
				break;
			default:
				$response = $this->response_dont_understood();
				break;
		}

		if( $echo ) {
			$this->send( $response );
		}

		return $response;
	}

	/**
	 * Preparing data for output to Alexa
	 *
	 * @since 1.0.0
	 *
	 * @param $response
	 *
	 * @return mixed
	 */
	private function send( $response ) {
		$response = json_encode( $response );
		$size = strlen ( $response );

		header( 'Content-Type: application/json' );
		header( 'Content-length: ' . $size );

		echo $response;
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

		return $this->input;
	}

	/**
	 * Response
	 *
	 * @return array
	 */
	public function response_launch() {
		return $this->response_speak( $this->text_launch );
	}

	public function response_end() {
		return $this->response_speak( $this->text_end );
	}

	public function response_dont_understood() {
		return $this->response_speak( $this->text_dont_understood );
	}

	abstract protected function interact( $intent );

	public function response_speak( $text, $session_attributes = array(), $should_end_session = true ) {
		$response = array(
			'version'   => '1.0',
			'sessionAttributes' => $session_attributes,
			'response' => array(
				'outputSpeech' => array(
					'type'  => 'PlainText',
					'text'  => $text
				),
				'shouldEndSession' => $should_end_session
			)
		);

		return $response;
	}
}