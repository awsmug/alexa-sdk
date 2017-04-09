<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class CardTestTest extends Alexa_TestCase {
	/**
	 * @var \Alexa\Output\Card
	 */
	var $card;

	public function setUp() {
		parent::setUp();
		$this->card = $this->skill->output()->response()->card();
	}

	public function testGetType(){
		$this->assertEquals( 'Standard', $this->card->get_type() );

		$this->card->set_type( 'Simple' );
		$this->assertEquals( 'Simple', $this->card->get_type() );

		$this->card->set_type( 'Standard' );
		$this->assertEquals( 'Standard', $this->card->get_type() );

		$this->card->set_type( 'LinkAccount' );
		$this->assertEquals( 'LinkAccount', $this->card->get_type() );

		$this->expectException( Exception::class );
		$this->card->set_type('Not_Possible_Value');
	}

	public function testGetTitle(){
		$this->assertFalse( $this->card->get_title() );

		$this->card->set_title( 'My Title' );
		$this->assertEquals( 'My Title', $this->card->get_title() );
	}

	public function testGetContent(){
		$this->assertFalse( $this->card->get_content() );

		$this->card->set_content( 'My Content' );
		$this->assertEquals( 'My Content', $this->card->get_content() );
	}

	public function testGetText(){
		$this->assertFalse( $this->card->get_text() );

		$this->card->set_text( 'My Text' );
		$this->assertEquals( 'My Text', $this->card->get_text() );
	}

	public function testGetLargeImage(){
		$this->assertFalse( $this->card->get_large_image() );

		$this->card->set_large_image( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=400' );
		$this->assertEquals( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=400', $this->card->get_large_image() );
	}

	public function testGetSmallImage(){
		$this->assertFalse( $this->card->get_small_image() );

		$this->card->set_small_image( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=200' );
		$this->assertEquals( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=200', $this->card->get_small_image() );
	}

	public function testSet() {
		$this->card->set( 'Standard', 'My Title', 'My Content', 'My Text', 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=200', 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=400' );

		$this->assertEquals( 'Standard', $this->card->get_type() );
		$this->assertEquals( 'My Title', $this->card->get_title() );
		$this->assertEquals( 'My Content', $this->card->get_content() );
		$this->assertEquals( 'My Text', $this->card->get_text() );
		$this->assertEquals( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=200', $this->card->get_small_image() );
		$this->assertEquals( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=400', $this->card->get_large_image() );
	}

	public function testHasValues() {
		$this->assertFalse( $this->card->has_values() );

		$this->card->set( 'Standard', 'My Title' );
		$this->assertTrue( $this->card->has_values() );
	}

	public function testGet(){
		$this->assertInstanceOf( '\stdClass', $this->card->get() );
	}
}