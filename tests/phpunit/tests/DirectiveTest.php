<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

use Alexa\Output\Directive;

class DirectiveTest extends Alexa_TestCase {
	/**
	 * @var Directive
	 */
	var $directive;


	public function setUp() {
		parent::setUp();
		$this->directive = new Directive();
	}

	public function testSetType(){
		$this->assertEquals( 'AudioPlayer.Play', $this->directive->get_type() );
		$this->assertEquals( 'AudioPlayer.Play', $this->directive->get()->type );

		$this->directive->set_type( 'AudioPlayer.Stop');
		$this->assertEquals( 'AudioPlayer.Stop', $this->directive->get_type() );
		$this->assertEquals( 'AudioPlayer.Stop', $this->directive->get()->type );

		$this->directive->set_type( 'AudioPlayer.ClearQueue');
		$this->assertEquals( 'AudioPlayer.ClearQueue', $this->directive->get_type() );
		$this->assertEquals( 'AudioPlayer.ClearQueue', $this->directive->get()->type );
	}

	public function testSetPlayBehaviour(){
		$this->assertEquals( 'REPLACE_ALL', $this->directive->get_play_behavior() );
		$this->assertEquals( 'REPLACE_ALL', $this->directive->get()->playBehavior );

		$this->directive->set_play_behavior( 'ENQUEUE');
		$this->assertEquals( 'ENQUEUE', $this->directive->get()->playBehavior );

		$this->directive->set_play_behavior( 'REPLACE_ENQUEUED');
		$this->assertEquals( 'REPLACE_ENQUEUED', $this->directive->get()->playBehavior );
	}

	public function testAudioItem(){
		$this->assertInstanceOf( 'Alexa\Output\Audio_Item', $this->directive->audio_item() );
	}
}