<?php

namespace Alexa\Media;

use Alexa\Skill_Template;
use Alexa\Output\Directive;
use Alexa\Playlist;

class Player_Skill extends Skill_Template {
	use Playlist;

	protected $text_launch = 'This is a media player.';

	protected $text_start = 'Playing %s.';

	protected $text_item_not_found = 'Could not find item to play.';

	protected $text_playback_failed = 'Playback of media file failed.';

	protected $reverse_playlist = false;

	public function __construct( $application_id ) {
		parent::__construct( $application_id );
	}

	public function intent_request() {
		$this->output()->response()->end_session();

		if ( 'Play' === $this->input()->request()->intent()->get_name() ) {
			$this->play();
		}

		if ( 'PlayLatest' === $this->input()->request()->intent()->get_name() ) {
			$this->play_latest();
		}

		if ( 'AMAZON.PauseIntent' === $this->input()->request()->intent()->get_name() ) {
			$this->pause();
		}

		if ( 'AMAZON.ResumeIntent' === $this->input()->request()->intent()->get_name() ) {
			$this->resume();
		}

		if ( 'AMAZON.NextIntent' === $this->input()->request()->intent()->get_name() ) {
			$this->next();
		}

		if ( 'AMAZON.PreviousIntent' === $this->input()->request()->intent()->get_name() ) {
			$this->previous();
		}

		if ( 'AudioPlayer.PlaybackFailed' === $this->input()->request()->intent()->get_name() ) {
			$this->output()->response()->output_speech()->set_text( $this->text_playback_failed );
		}

		return $this->output()->get_json();
	}

	protected function play() {
		$number     = $this->input()->request()->intent()->get_slot_value( 'Number' );
		$media_file = $this->playlist_get( $number - 1 );

		if ( ! $media_file ) {
			$this->output()->response()->output_speech()->set_text( sprintf( $this->text_item_not_found, 1, $this->playlist_count_items() ) );
			$this->output()->response()->end_session( false );

			return;
		}

		$directive = $this->get_directive( $media_file );
		$this->output()->response()->add_directive( $directive );

		$this->output()->response()->card()->set_text( $media_file['title'] );
		if ( ! empty( $media_file['image'] ) ) {
			$this->output()->response()->card()->set_small_image( $media_file['image'] );
		}

		$this->output()->response()->output_speech()->set_text( sprintf( $this->text_start, $media_file['title'] ) );
	}

	protected function play_latest() {
		$media_file = $this->playlist_get( $this->playlist_count_items() - 1 );

		$directive = $this->get_directive( $media_file );
		$this->output()->response()->add_directive( $directive );

		$this->output()->response()->card()->set_text( $media_file['title'] );
		if ( ! empty( $media_file['image'] ) ) {
			$this->output()->response()->card()->set_small_image( $media_file['image'] );
		}

		$this->output()->response()->output_speech()->set_text( sprintf( $this->text_start, $media_file['title'] ) );
	}

	protected function pause() {
		$directive = new Directive();
		$directive->set_type( 'AudioPlayer.Stop' );
		$this->output()->response()->add_directive( $directive );
	}

	protected function resume() {
		$actual_token = $this->input()->context()->audio_player()->get_token();
		$offset       = $this->input()->context()->audio_player()->get_offset();
		$media_file   = $this->playlist_get_by_token( $actual_token );

		$directive = $this->get_directive( $media_file );
		$directive->audio_item()->stream()->set_offset( $offset );
		$this->output()->response()->add_directive( $directive );
		$this->output()->response()->output_speech()->set_text( sprintf( $this->text_start, $media_file['title'] ) );
	}

	protected function next() {
		$actual_token = $this->input()->context()->audio_player()->get_token();
		$media_file   = $this->playlist_get_next_by_token( $actual_token );
		$directive    = $this->get_directive( $media_file );

		if ( ! $media_file ) {
			$offset     = $this->input()->context()->audio_player()->get_offset();
			$media_file = $this->playlist_get_by_token( $actual_token );
			$directive  = $this->get_directive( $media_file );
			$directive->audio_item()->stream()->set_offset( $offset );
		}

		$this->output()->response()->add_directive( $directive );
		$this->output()->response()->output_speech()->set_text( sprintf( $this->text_start, $media_file['title'] ) );
	}

	protected function previous() {
		$actual_token = $this->input()->context()->audio_player()->get_token();
		$media_file   = $this->playlist_get_previous_by_token( $actual_token );

		$directive = $this->get_directive( $media_file );
		$this->output()->response()->add_directive( $directive );
		$this->output()->response()->output_speech()->set_text( sprintf( $this->text_start, $media_file['title'] ) );
	}

	protected function get_directive( $media_file ) {
		$directive = new Directive();
		$directive->set_play_behavior( 'REPLACE_ALL' );
		$directive->audio_item()->stream()->set_url( $media_file['url'] );
		$directive->audio_item()->stream()->set_token( $media_file['token'] );

		return $directive;
	}
}