<?php

namespace Alexa\Output;

use Alexa\Output_Object;
use Alexa\Exception;

/**
 * Class Directive
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Directive implements Output_Object {
	/**
	 * Type of Directive
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $type = 'AudioPlayer.Play';

	/**
	 * Play behaviour
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $play_behavior = 'REPLACE_ALL';

	/**
	 * Audio item object
	 *
	 * @since 1.0.0
	 *
	 * @var Audio_Item
	 */
	private $audio_item;

	/**
	 * Directive type
	 *
	 * @since 1.0.0
	 *
	 * @param string $type AudioPlayer.Play, AudioPlayer.Stop or AudioPlayer.ClearQueue
	 *
	 * @throws Exception
	 */
	public function set_type( $type ) {
		if( 'AudioPlayer.Play' !== $type && 'AudioPlayer.Stop' !== $type && 'AudioPlayer.ClearQueue' !== $type ) {
			throw new Exception( sprintf( 'Directive Type %s does not exist', $type ) );
		}

		$this->type = $type;
	}

	/**
	 * Get directive type
	 *
	 * @since 1.0.0
	 *
	 * @return string AudioPlayer.Play, AudioPlayer.Stop or AudioPlayer.ClearQueue
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Play behaviour
	 *
	 * @since 1.0.0
	 *
	 * @param string $behavior REPLACE_ALL, ENQUEUE or REPLACE_ENQUEUED
	 *
	 * @throws Exception
	 */
	public function set_play_behavior( $play_behavior ) {
		if( 'REPLACE_ALL' !== $play_behavior && 'ENQUEUE' !== $play_behavior && 'REPLACE_ENQUEUED' !== $play_behavior ) {
			throw new Exception( sprintf( 'Play Behaviour %s does not exist', $play_behavior ) );
		}

		$this->play_behavior = $play_behavior;
	}

	/**
	 * Get directive type
	 *
	 * @since 1.0.0
	 *
	 * @return string REPLACE_ALL, ENQUEUE or REPLACE_ENQUEUED
	 */
	public function get_play_behavior() {
		return $this->play_behavior;
	}

	/**
	 * Accessing Audio Item Object
	 *
	 * @since 1.0.0
	 *
	 * @return Audio_Item
	 */
	public function audio_item() {
		if( empty ( $this->audio_item ) ) {
			$this->audio_item = new Audio_Item();
		}
		return $this->audio_item;
	}

	/**
	 * Getting Object content
	 *
	 * @since 1.0.0
	 *
	 * @return \StdClass $object
	 */
	public function get() {
		$object = new \stdClass();

		$object->type = $this->type;

		$object->playBehavior = $this->play_behavior;

		if( $this->audio_item()->has_values() ) {
			$object->audioItem = $this->audio_item()->get();
		}

		return $object;
	}
}