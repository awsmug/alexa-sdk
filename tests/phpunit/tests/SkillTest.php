<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class SkillTest extends Alexa_TestCase {
	public function setUp() {
		parent::setUp();
		$this->skill->input( $this->input[ 'LaunchRequest' ] );
	}

	public function testInput(){
		$this->assertInstanceOf( 'Alexa\Input\Input_Stream', $this->skill->input() );
	}

	public function testOutput() {
		$this->assertInstanceOf( 'Alexa\Output\Output_Stream', $this->skill->output() );
	}
}