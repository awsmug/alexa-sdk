<?php

require_once dirname( dirname( __FILE__ ) ) . '/alexa-config.php';
require_once dirname( dirname( __FILE__ ) ) . '/src/alexa-sdk.php';

use Alexa\Skill_Template;

class Helene_Fischer_Blocker extends Skill_Template {
	public function __construct( $app_id ) {
		$answers = array(
			'Halts Maul Du Idiot!',
			'Geh doch zu Hause Du alte Scheiße!',
			'Hast Du zu viel Lack gesoffen?',
			'So nen Kack kannste zu Hause machen!',
			'Ich spiele so einen Schrott nicht!',
			'Geh sterben!',
			'Du armer Hans!',
			'Alter bist so Du Geschmacklos!',
			'Du machst wohl auch auf dem Ballermann Urlaub!',
			'So n Niveauloses Zeug spiel ich nicht!',
		);

		$number = array_rand( $answers );

		$this->text_launch = $answers[ $number ];

		parent::__construct( $app_id );
	}

	public function intent_request() {
		$this->output()->response()->output_speech()->set_text( $this->text_launch );
		$this->output()->response()->end_session();
	}
}

$helene_blocker = new Helene_Fischer_Blocker( $helene_fisher_app_id );

try{
	$helene_blocker->run();
} catch( Exception $exception) {
	$helene_blocker->log( $exception->getMessage() );
	echo $exception->getMessage();
}