<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class ApplicationTest extends Alexa_TestCase {
	/**
	 * @var Alexa\Input\Application
	 */
	var $application;

	public function setUp() {
		parent::setUp();
		$this->application = $this->skill->input( $this->input[ 'IntentRequest' ] )->session()->application();
	}

	public function testGetId() {
		$this->assertEquals( $this->app_id, $this->application->get_id() );
	}

	public function testIdEquals() {
		$this->assertTrue( $this->application->id_equals( $this->app_id ) );
	}
}