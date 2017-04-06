<?php

namespace Alexa;

/**
 * Class Context
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Context {
	Use Raw_Object;

	/**
	 * System Data
	 *
	 * @since 1.0.0
	 *
	 * @var System
	 */
	protected $system;

	/**
	 * Audio Player Data
	 *
	 * @since 1.0.0
	 *
	 * @var Audio_Player
	 */
	protected $audio_player;

	/**
	 * Request constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Input from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;
	}

	/**
	 * Get System
	 *
	 * @since 1.0.0
	 *
	 * @return System $system
	 *
	 * @throws Exception
	 */
	public function system() {
		if( empty( $this->system ) ) {
			$this->system = new System( $this->object->System );
		}

		return $this->system;
	}

	/**
	 * Get Audio Player
	 *
	 * @since 1.0.0
	 *
	 * @return Audio_Player $audio_player
	 *
	 * @throws Exception
	 */
	public function audio_player() {
		if( empty( $this->audio_player ) ) {
			$this->audio_player = new Audio_Player( $this->object->AudioPlayer );
		}

		return $this->audio_player;
	}
}