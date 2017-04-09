<?php

class Alexa_TestCase extends PHPUnit_Framework_TestCase {
	/**
	 * @var string Session ID
	 */
	var $session_id;

	/**
	 * @var string Application ID
	 */
	var $app_id;

	/**
	 * @var string User ID
	 */
	var $user_id;

	/**
	 * @var string Request ID
	 */
	var $request_id;

	/**
	 * @var string Locale
	 */
	var $locale;

	/**
	 * @var string Timestamp
	 */
	var $timestamp;

	/**
	 * @var string Intent name
	 */
	var $intent_name;

	/**
	 * @var Alexa\Skill;
	 */
	var $skill;

	/**
	 * @var Alexa\Input\Input_Stream
	 */
	var $input;

	/**
	 * Setting up vars
	 */
	public function setUp() {
		$this->app_id = 'app1234567890';
		$this->user_id = 'user1234567890';
		$this->request_id = 'request1234567890';
		$this->session_id = 'session1234567890';

		$this->locale = 'de-DE';
		$this->timestamp = '2017-04-06T06:55:56Z';
		$this->intent_name = 'MyIntent';

		$this->skill = new Test_Skill_Class( $this->app_id );

		$this->input = array(
			'LaunchRequest' => json_decode( '{
			  "session": {
			    "sessionId": "' . $this->session_id . '",
			    "application": {
			      "applicationId": "' . $this->app_id . '"
			    },
			    "attributes": {},
			    "user": {
			      "userId": "' . $this->user_id . '"
			    },
			    "new": true
			  },
			  "request": {
			    "type": "LaunchRequest",
			    "requestId": "' . $this->request_id . '",
			    "locale": "' . $this->locale . '",
			    "timestamp": "' . $this->timestamp . '"
			  },
			  "version": "1.0"
			}' ),
		    'IntentRequest' => json_decode( '{
			  "session": {
			    "sessionId": "' . $this->session_id . '",
			    "application": {
			      "applicationId": "' . $this->app_id . '"
			    },
			    "attributes": {},
			    "user": {
			      "userId": "' . $this->user_id . '"
			    },
			    "new": true
			  },
			  "request": {
			    "type": "IntentRequest",
			    "requestId": "' . $this->request_id . '",
			    "locale": "' . $this->locale . '",
			    "timestamp": "' . $this->timestamp . '",
			    "intent": {
			      "name": "' . $this->intent_name . '",
			      "slots": {
			        "PodcastNumber": {
			          "name": "PodcastNumber",
			          "value": "1"
			        }
			      }
			    }
			  },
			  "version": "1.0"
			}')
		);
	}
}