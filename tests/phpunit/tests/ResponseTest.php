<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class ResponseTest extends Alexa_TestCase {
	/**
	 * @var \Alexa\Output\Response
	 */
	var $response;

	public function setUp() {
		parent::setUp();
		$this->response = $this->skill->output()->response();
	}

	public function testOutputSpeech(){
		$this->assertInstanceOf( 'Alexa\Output\Output_Speech', $this->response->output_speech() );
	}

	public function testCard(){
		$this->assertInstanceOf( 'Alexa\Output\Card', $this->response->card() );
	}

	public function testReprompt(){
		$this->assertInstanceOf( 'Alexa\Output\Reprompt', $this->response->reprompt() );
	}

	public function testGet(){
		$this->assertInstanceOf( '\stdClass', $this->response->get() );
	}
}