<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once dirname( dirname( __FILE__ ) ) . '/src/alexa-sdk.php';

use Alexa\Skill_Template;
use Alexa\Exception;

class Simple_Skill extends Skill_Template {

	public function intent_request() {

		if( $this->input()->request()->has_intent() ) {
			$this->log( $this->input()->request()->intent()->get_slots() );
			$this->log( $this->input()->request()->intent()->get_slot_value( 'PodcastNumber' ) );
		}

		/**
		 * Put in your answer stuff here!
		 */
		$this->output()->response()->output_speech()->set_text( 'You started the skill!' );

		$this->output()->response()->card()->set_title( 'Simple Skill card' );
		$this->output()->response()->card()->set_text('This is a dummy Text for my Skill Card.');

		$this->output()->response()->end_session();
	}
}

$simple_skill = new Simple_Skill( 'amzn1.ask.skill.f66f9cb9-c632-42bb-be50-210f1d6164b6' );

try{
	$simple_skill->run();
} catch( Exception $exception) {
	$simple_skill->log( $exception->getMessage() );
	echo $exception->getMessage();
}