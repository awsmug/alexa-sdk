<?php

namespace Alexa;

/**
 * We just need an autoloader to load library
 */
require_once dirname( __FILE__ ) . '/autoloader-class.php';

Autoloader::init();

class Test_Skill extends Skill {
	protected function interact( $intent ) {

	}
}