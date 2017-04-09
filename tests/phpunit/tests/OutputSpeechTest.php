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

	public function testGetType(){
		$this->assertEquals( 'PlainText', $this->output_speech->get_type());

		$this->output_speech->set_type( 'SSML' );
		$this->assertEquals( 'SSML', $this->output_speech->get_type());

		$this->expectException( Exception::class );
		$this->output_speech->set_type('Not_Possible_Value');
	}

	public function testGetText(){
		$this->assertFalse( $this->output_speech->get_text() );

		$this->output_speech->set_text( 'This is my text' );
		$this->assertEquals( 'This is my text', $this->output_speech->get_text() );
	}

	public function testGetSsml(){
		$this->assertFalse( $this->output_speech->get_ssml() );

		$this->output_speech->set_ssml( '<speak>This output speech uses SSML.</speak>' );
		$this->assertEquals( '<speak>This output speech uses SSML.</speak>', $this->output_speech->get_ssml() );
	}

	public function testSet() {
		$this->output_speech->set( 'PlainText', 'This is my text' );
		$this->assertEquals( 'PlainText', $this->output_speech->get_type() );
		$this->assertEquals( 'This is my text', $this->output_speech->get_text() );

		$this->output_speech->set( 'SSML', '<speak>This output speech uses SSML.</speak>' );
		$this->assertEquals( 'SSML', $this->output_speech->get_type() );
		$this->assertEquals( '<speak>This output speech uses SSML.</speak>', $this->output_speech->get_ssml() );
	}
}