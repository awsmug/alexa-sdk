<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class SessionIntentTest extends Alexa_TestCase {
	/**
	 * @var Alexa\Input\Session
	 */
	var $session;

	public function setUp() {
		parent::setUp();
		$this->session = $this->skill->input( $this->input[ 'IntentRequest' ] )->session();
	}

	public function testGetId() {
		$this->assertEquals( $this->session_id, $this->session->get_id() );
	}

	public function testIdEquals() {
		$this->assertTrue( $this->session->id_equals( $this->session_id ) );
	}

	public function testApplication(){
		$this->assertInstanceOf( 'Alexa\Input\Application', $this->session->application() );
	}

	public function testUser(){
		$this->assertInstanceOf( 'Alexa\Input\User', $this->session->user() );
	}

	public function testGetAttributes(){
		$this->assertFalse( $this->session->get_attributes() );
	}

	public function testGetAttribute(){
		$this->assertFalse( $this->session->get_attributes( 'not_existing_attribute' ) );
	}
}