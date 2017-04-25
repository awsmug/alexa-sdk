<?php

namespace Alexa\Media;

class Podcast_Skill extends Player_Skill {
	/**
	 * URL to podcast Feed
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $podcast_url;

	protected $text_launch = 'This is a Podcast.';

	protected $text_start = 'Playing episode %s.';

	protected $text_item_not_found = 'Podcast not found. Please choose an number between %d and %d.';

	protected $text_playback_failed = 'Playback of Podcast file failed.';

	protected $reverse_playlist = true;

	public function __construct( $application_id ) {
		parent::__construct( $application_id );
	}

	public function intent_request() {
		$this->add_podcast_files();
    	parent::intent_request();
	}

	private function get_feed_media() {
		$dom = new \DOMDocument();
		$dom->load( $this->podcast_url, LIBXML_NOWARNING );
		$media_files = array();

		foreach ( $dom->getElementsByTagName( 'item' ) as $node ) {
			$url  = $node->getElementsByTagName( 'enclosure' )->item( 0 )->getAttribute( 'url' );
			$item = array(
				'title' => $node->getElementsByTagName( 'title' )->item( 0 )->nodeValue,
				/*
				'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				'guid' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
				'enclosure' => $node->getElementsByTagName('enclosure')->item(0)->nodeValue,
				'image' => $node->getElementsByTagName( 'image' )->item(0)->getAttribute( 'href' ),
				*/
				'url'   => $url
			);
			array_push( $media_files, $item );
		}

		return $media_files;
	}

	private function add_podcast_files() {
		$media_files = $this->get_feed_media();

		foreach ( $media_files AS $media_file ) {
			$this->playlist_add( $media_file['url'], $media_file['title'] );
		}

		if ( $this->reverse_playlist ) {
			$this->playlist_reverse();
		}
	}
}