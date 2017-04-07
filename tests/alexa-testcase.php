<?php

// use PHPUnit\Framework\TestCase;

require dirname( dirname( __FILE__ ) ) . '/src/alexa-sdk.php';

class AlexaTestCase extends PHPUnit_Framework_TestCase  {
	protected $app_id;
	protected $user_id;

	public function setUp() {
		$this->app_id = 'app1234567890';
		$this->user_id = 'user1234567890';
	}
}