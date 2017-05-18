<?php

require_once dirname( dirname( __FILE__ ) ) . '/alexa-config.php';
require_once dirname( dirname( __FILE__ ) ) . '/src/alexa-sdk.php';

use Alexa\Media\Podcast_Skill;

class WP_Sofa_Podcast extends Podcast_Skill {

	public function __construct( $application_id ) {
		$this->text_launch         = 'Cool! Datt WP Sofa iss immer noch datt schönste! Welche Folge willste hören?';
		$this->text_end            = 'Ach mensch hier iss doch so jemütlich! Na dann geh doch!';
		$this->text_failed         = 'Man man man, Du musst schon deutlicher sprechen';
		$this->text_start          = '%s';
		$this->text_item_not_found = 'Ich kann die Folge nicht finden. Suche Dir ne Folge zwischen %d und %d aus!';

		$this->podcast_url = 'https://m4a.wp-sofa.de/';

		parent::__construct( $application_id );
	}
}

$podcast = new WP_Sofa_Podcast( $wp_sofa_app_id );

try {
	$podcast->run();
} catch ( Exception $exception ) {
	$podcast->log( $exception->getMessage() );
	echo $exception->getMessage();
}