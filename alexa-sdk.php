<?php

namespace Alexa;

/**
 * We just need an autoloader to load library
 */
require_once dirname( __FILE__ ) . '/autoloader-class.php';

Autoloader::init();

class Test_Skill extends Skill {
	protected function interact( $intent ) {
		// TODO: Implement interact() method.
	}
}

$skill = new Test_Skill( 'amzn1.ask.skill.f66f9cb9-c632-42bb-be50-210f1d6164b6' );
$skill->input();