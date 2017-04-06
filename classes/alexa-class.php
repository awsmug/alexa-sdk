<?php

namespace Alexa;

require_once dirname( dirname( __FILE__ ) ) . '/Requests.php';

require_once dirname( __FILE__ ) . '/exception-class.php';
require_once dirname( __FILE__ ) . '/logger-trait.php';

abstract class Controller {
	use Logger;

	private $input;

	private $request_type;

	protected $app_id;

	protected $session_id;

	protected $user_id;

	protected $text_launch = 'Hello! I am an Alexa Skill.';

	protected $text_end = 'Good bye!';

	protected $text_dont_understood = 'I did not understood you.';

	public function __construct() {
		\Requests::register_autoloader();
	}

	public function listen() {
		$php_input = file_get_contents( 'php://input' );

		if( empty( $php_input ) ) {
			throw new Exception( 'No input from Alexa' );
		}

		$this->input = json_decode( $php_input );

		if( $this->input->session->application->applicationId !== $this->app_id ) {
			throw new Exception( 'Wrong Application ID' );
		}

		$this->session_id = $this->input->session->sessionId;
		$this->user_id = $this->input->session->user->userId;

		$this->request_type = $this->input->request->type;
		return $this->input->request;
	}

	public function answer() {
		switch ( $this->request_type ) {
			case "LaunchRequest":
				$response = $this->launch();
				break;
			case "SessionEndedRequest":
				$response = $this->end();
				break;
			case "IntentRequest":
				$response = $this->interact( $this->input->request->intent );
				break;
			default:
				$response = $this->dont_understood();
				break;
		}

		$response = json_encode( $response );

		$size = strlen ( $response );

		header( 'Content-Type: application/json' );
		header( 'Content-length: ' . $size );

		return $response;
	}

	public function launch() {
		return $this->speak( $this->text_launch );
	}

	public function end() {
		return $this->speak( $this->text_end );
	}

	public function dont_understood() {
		return $this->speak( $this->text_dont_understood );
	}

	abstract public function interact( $intent );

	public function speak( $text, $session_attributes = array(), $should_end_session = true ) {
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