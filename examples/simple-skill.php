<?php

require_once dirname( dirname( __FILE__ ) ) . '/alexa-config.php';
require_once dirname( dirname( __FILE__ ) ) . '/src/alexa-sdk.php';

use Alexa\Skill_Template;
use Alexa\Exception;

class Simple_Skill extends Skill_Template {

	public function intent_request() {
		/**
		 * Put in your answer stuff here!
		 */
		$this->output()->response()->output_speech()->set_text( 'You started the skill!' );

		$this->output()->response()->card()->set_title( 'Simple Skill card' );
		$this->output()->response()->card()->set_text('This is a dummy Text for my Skill Card.');

		$this->output()->response()->end_session();
	}
}

$simple_skill = new Simple_Skill( $simple_skill_app_id );

try{
	$simple_skill->run();
} catch( Exception $exception) {
	$simple_skill->log( $exception->getMessage() );
	echo $exception->getMessage();
}