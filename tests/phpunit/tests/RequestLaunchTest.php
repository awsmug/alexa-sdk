<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class RequestLaunchTest extends Alexa_TestCase {
	/**
	 * @var Alexa\Input\Request
	 */
	var $request;

	public function setUp() {
		parent::setUp();
		$this->request = $this->skill->input( $this->input[ 'LaunchRequest' ] )->request();
	}

	/**
	 * @​expectedException
	 */
	public function testIntent(){
		$this->expectException( Exception::class );
		$this->request->intent();
	}

	public function testType(){
		$this->assertEquals( 'LaunchRequest', $this->request->get_type() );
	}

	public function testId(){
		$this->assertEquals( $this->request_id, $this->request->get_id() );
	}

	public function testLocale(){
		$this->assertEquals( $this->locale, $this->request->get_locale() );
	}

	public function testTimestamp(){
		$this->assertEquals( $this->timestamp, $this->request->get_timestamp() );
	}

	public function testHasIntent(){
		$this->assertFalse( $this->request->has_intent() );
	}
}