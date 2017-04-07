<?php

ini_set('error_reporting', E_ALL ); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once 'alexa-testcase.php';
require_once 'test-skill-class.php';

class SkillClassTest extends AlexaTestCase {
	/**
	 * @var Test_Skill
	 */
	private $skill;

	private $input = array();

	public function setUp() {
		require dirname( dirname( __FILE__ ) ) . '/alexa-config.php';

		$this->skill = new Test_Skill( $alexa_app_id );

		$this->input = array(
			'LaunchRequest' => json_decode( '{
			  "session": {
			    "sessionId": "SessionId.d1f73a18-af8e-4d19-ada8-2dea0375ab54",
			    "application": {
			      "applicationId": "' . $alexa_app_id . '"
			    },
			    "attributes": {},
			    "user": {
			      "userId": "amzn1.ask.account.AFTZKCLS6HZ5EC2C4ONVHW36V2COG4TVQI5WZRQNAT3C3DYCUEPWKHOUAW7DI7SU5EAZQMZEUAIL2HX2LKDVHHDXZGLB2YFULY7R2F5UDC4PJGGCCN53FN2M7ZM5QBU2QETVT64BXSG4CFK37ZQNPQYYKC4EV62NSLPDMMVA72IYSBQCCDDR5HNEOUWGWFSEO4N5EFEPC74RDYY"
			    },
			    "new": true
			  },
			  "request": {
			    "type": "LaunchRequest",
			    "requestId": "EdwRequestId.b76c6956-2ec6-431c-a5a9-fb15041f61ee",
			    "locale": "de-DE",
			    "timestamp": "2017-04-05T15:43:45Z"
			  },
			  "version": "1.0"
			}' )
		);
	}

	public function testInputStream(){
		$input = $this->skill->input( $this->input[ 'LaunchRequest' ] );
		$this->assertInstanceOf( 'Alexa\Input\Input_Stream', $input );
	}

	public function testRequest(){
		$input = $this->skill->input( $this->input[ 'LaunchRequest' ] );
		$this->assertInstanceOf( 'Alexa\Input\Request', $input->request() );
	}

	public function testSession(){
		$input = $this->skill->input( $this->input[ 'LaunchRequest' ] );
		$this->assertInstanceOf( 'Alexa\Input\Session', $input->session() );
	}

	public function testVersion(){
		$input = $this->skill->input( $this->input[ 'LaunchRequest' ] );
		$this->assertEquals( '1.0', $input->get_version() );
	}
}