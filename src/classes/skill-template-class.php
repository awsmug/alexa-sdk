<?php

namespace Alexa;

/**
 * Class Skill_Template
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
abstract class Skill_Template extends Skill {
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
	protected $text_failed = 'I did not understood you.';

	/**
	 * Skill_Template constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $application_id
	 */
	public function __construct( $application_id ) {
		parent::__construct( $application_id );
	}

	/**
	 * Basic interacting
	 *
	 * @since 1.0.0
	 *
	 * @return \StdClass
	 */
	public function interact() {
		switch( $this->input()->request()->get_type() ) {
			case 'LaunchRequest':
				$response = $this->launch_request();
				break;
			case 'IntentRequest':
				$response = $this->intent_request();
				break;
			case 'EndRequest':
				$response = $this->end_request();
				break;
			default:
				$response = $this->failed_request();
				break;
		}

		return $response;
	}

	/**
	 * Doing a simple run of a Skill
	 *
	 * @since 1.0.0
	 */
	public function run(){
		$this->input();
		$this->interact();
		echo $this->output()->get_json();
	}

	/**
	 * Intent Request
	 *
	 * @since 1.0.0
	 *
	 * @return \stdClass Request object
	 */
	abstract function intent_request();

	/**
	 * Launch Request
	 *
	 * @since 1.0.0
	 *
	 * @return \stdClass Request object
	 */
	protected function launch_request() {
		$this->output()->response()->output_speech()->set_text( $this->text_launch );
		return $this->output()->response()->get();
	}

	/**
	 * End Request
	 *
	 * @since 1.0.0
	 *
	 * @return \stdClass Request object
	 */
	protected function end_request() {
		$this->output()->response()->output_speech()->set_text( $this->text_end );
		return $this->output()->response()->get();
	}

	/**
	 * Failed Request
	 *
	 * @since 1.0.0
	 *
	 * @return \stdClass Request object
	 */
	protected function failed_request() {
		$this->output()->response()->output_speech()->set_text( $this->text_failed );
		return $this->output()->response()->get();
	}
}