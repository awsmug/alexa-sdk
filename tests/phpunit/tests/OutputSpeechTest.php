<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class OutputSpeechTest extends Alexa_TestCase {
	/**
	 * @var \Alexa\Output\Output_Speech
	 */
	var $output_speech;

	public function setUp() {
		parent::setUp();
		$this->output_speech = $this->skill->output()->response()->output_speech();
	}

	public function testSetText(){
		$this->assertFalse( $this->output_speech->get_text() );

		$this->output_speech->set_text( 'This is my text' );
		$this->assertEquals( 'This is my text', $this->output_speech->get_text() );
		$this->assertEquals( 'This is my text', $this->output_speech->get()->text );
		$this->assertEquals( 'PlainText', $this->output_speech->get()->type );
	}

	public function testSetSsml(){
		$this->assertFalse( $this->output_speech->get_ssml() );

		$this->output_speech->set_ssml( '<speak>This output speech uses SSML.</speak>' );
		$this->assertEquals( '<speak>This output speech uses SSML.</speak>', $this->output_speech->get_ssml() );
		$this->assertEquals( '<speak>This output speech uses SSML.</speak>', $this->output_speech->get()->ssml );
		$this->assertEquals( 'SSML', $this->output_speech->get()->type );
	}

	public function testHasValues() {
		$this->assertFalse( $this->output_speech->has_values() );
		$this->output_speech->set_text( 'This is my Text' );

		$this->assertTrue( $this->output_speech->has_values() );
	}

	public function testGet(){
		$this->assertInstanceOf( '\stdClass', $this->output_speech->get() );
	}
}