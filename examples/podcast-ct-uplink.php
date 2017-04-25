<?php

require_once dirname( __FILE__ ) . '/podcast-skill-class.php';

class CT_Uplink_Podcast extends Podcast_Skill {

    public function __construct( $application_id )
    {
        $this->text_launch = 'Willkommen bei CT Uplink! Welche Folge willst Du hören?';
        $this->text_end = 'Ach mensch hier iss doch so jemütlich! Naja, dann geh doch!';
        $this->text_failed = 'Man man man, Du muss schon deutlicher sprechen';
        $this->text_start_podcast = '%s';
        $this->text_podcast_number_not_found = 'Ich kann die Folge nicht finden. Suche Dir ne Folge zwischen %d und %d aus!';

        $this->podcast_url = 'https://www.heise.de/ct/uplink/ctuplink.rss';

        parent::__construct( $application_id );
    }
}

$wp_sofa = new CT_Uplink_Podcast( 'amzn1.ask.skill.83b2acd2-da0f-468c-ad4e-22c24e86759c' );

try{
    $wp_sofa->run();
} catch( Exception $exception) {
    $wp_sofa->log( $exception->getMessage() );
    echo $exception->getMessage();
}