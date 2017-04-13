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

	public function testSetType(){
		$this->assertEquals( 'Standard', $this->card->get_type() );

		$this->card->set_type( 'Simple' );
		$this->assertEquals( 'Simple', $this->card->get_type() );
		$this->assertEquals( 'Simple', $this->card->get()->type );

		$this->card->set_type( 'Standard' );
		$this->assertEquals( 'Standard', $this->card->get_type() );
		$this->assertEquals( 'Standard', $this->card->get()->type );

		$this->card->set_type( 'LinkAccount' );
		$this->assertEquals( 'LinkAccount', $this->card->get_type() );
		$this->assertEquals( 'LinkAccount', $this->card->get()->type );

		$this->expectException( Exception::class );
		$this->card->set_type('Not_Possible_Value');
	}

	public function testSetTitle(){
		$this->assertFalse( $this->card->get_title() );

		$this->card->set_title( 'My Title' );
		$this->assertEquals( 'My Title', $this->card->get_title() );
		$this->assertEquals( 'My Title', $this->card->get()->title );
	}

	public function testSetContent(){
		$this->assertFalse( $this->card->get_content() );

		$this->card->set_content( 'My Content' );
		$this->assertEquals( 'My Content', $this->card->get_content() );
		$this->assertEquals( 'My Content', $this->card->get()->content );
	}

	public function testSetText(){
		$this->assertFalse( $this->card->get_text() );

		$this->card->set_text( 'My Text' );
		$this->assertEquals( 'My Text', $this->card->get_text() );
		$this->assertEquals( 'My Text', $this->card->get()->text );
	}

	public function testSetLargeImage(){
		$this->assertFalse( $this->card->get_large_image() );

		$this->card->set_large_image( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=400' );
		$this->assertEquals( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=400', $this->card->get_large_image() );
		$this->assertEquals( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=400', $this->card->get()->image->largeImageUrl );
	}

	public function testGetSmallImage(){
		$this->assertFalse( $this->card->get_small_image() );

		$this->card->set_small_image( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=200' );
		$this->assertEquals( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=200', $this->card->get_small_image() );
		$this->assertEquals( 'https://avatars0.githubusercontent.com/u/11785344?v=3&s=200', $this->card->get()->image->smallImageUrl );
	}

	public function testHasValues() {
		$this->assertFalse( $this->card->has_values() );

		$this->card->set_title( 'Test' );
		$this->assertTrue( $this->card->has_values() );
	}
}