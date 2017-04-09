<?php
/**
 * Simple Skill Class for testing
 */

use Alexa\Skill_Template;

class Test_Skill extends Skill_Template {
	public function __construct( $application_id ) {
		parent::__construct( $application_id );
	}

	public function intent_request() {
		return $this->output()->response()->output_speech()->set_text( 'This is a test Skill.' );
	}
}