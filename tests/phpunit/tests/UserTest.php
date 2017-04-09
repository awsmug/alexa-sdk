<?php

require_once dirname( dirname( __FILE__ ) ) . '/includes/bootstrap.php';

class UserTest extends Alexa_TestCase {
	/**
	 * @var Alexa\Input\User
	 */
	var $user;

	public function setUp() {
		parent::setUp();
		$this->user = $this->skill->input( $this->input[ 'IntentRequest' ] )->session()->user();
	}

	public function testGetId() {
		$this->assertEquals( $this->user_id, $this->user->get_id() );
	}

	public function testIdEquals() {
		$this->assertTrue( $this->user->id_equals( $this->user_id ) );
	}

	public function testAccessToken() {
		$this->assertFalse( $this->user->get_access_token() );
	}


	public function testPermissions() {
		$this->expectException( Exception::class );
		$this->user->permissions();
	}
}