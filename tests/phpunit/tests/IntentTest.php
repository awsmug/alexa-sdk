<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class IntentTest extends Alexa_TestCase {
	/**
	 * @var Alexa\Input\Intent
	 */
	var $intent;

	public function setUp() {
		parent::setUp();
		$this->intent = $this->skill->input( $this->input[ 'IntentRequest' ] )->request()->intent();
	}

	public function testName(){
		$this->assertEquals( $this->intent_name, $this->intent->get_name() );
	}

	public function testGetSlots(){
		$this->assertArrayHasKey( 'PodcastNumber', $this->intent->get_slots() );
	}

	public function testGetSlotNames(){
		$this->assertArraySubset( array( 'PodcastNumber' ) , $this->intent->get_slot_names() );
	}

	public function testGetSlotValue(){
		$this->assertEquals( 1, $this->intent->get_slot_value( 'PodcastNumber') );
		$this->assertFalse( $this->intent->get_slot_value( 'NotExistingSlot') );
	}
}