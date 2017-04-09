<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class OutputTest extends Alexa_TestCase {
	/**
	 * @var \Alexa\Output\Output_Stream
	 */
	var $output;

	public function setUp() {
		parent::setUp();
		$this->output = $this->skill->output();
	}

	public function testVersion(){
		$this->assertEquals('1.0', $this->output->get_version() );

		$this->output->set_version( '1.1' );
		$this->assertEquals( '1.1', $this->output->get_version() );
	}

	public function testSessionAttributes(){
		$this->output->add_session_attribute( 'name', 'John Doe' );

		// print_r( $this->output->get_session_attributes() );
		// $this->assertArraySubset( array( 'name' => 'John Doe' ), $this->output->get_session_attributes() );
		// $this->assertEquals(  'John Doe', $this->output->get_session_attribute( 'name' ) );
	}

	public function testResponse(){
		$this->assertInstanceOf( 'Alexa\Output\Response', $this->output->response() );
	}
}