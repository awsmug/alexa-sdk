<?php

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once 'alexa-config.php';
require_once 'alexa-testcase.php';
require_once 'test-skill-class.php';

class SkillClassTest extends AlexaTestcase {
	public function testRequest(){
		$this->assertTrue( true );
	}
}