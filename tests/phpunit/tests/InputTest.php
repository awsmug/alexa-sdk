<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class InputTest extends Alexa_TestCase {
	public function setUp() {
		parent::setUp();
		$this->skill->input( $this->input[ 'LaunchRequest' ] );
	}

	public function testRequest(){
		$input = $this->skill->input( $this->input[ 'LaunchRequest' ] );
		$this->assertInstanceOf( 'Alexa\Input\Request', $input->request() );
	}

	public function testSession(){
		$input = $this->skill->input( $this->input[ 'LaunchRequest' ] );
		$this->assertInstanceOf( 'Alexa\Input\Session', $input->session() );
	}

	public function testVersion(){
		$input = $this->skill->input( $this->input[ 'LaunchRequest' ] );
		$this->assertEquals( '1.0', $input->get_version() );
	}
}