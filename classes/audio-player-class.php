<?php

namespace Alexa;

/**
 * Class System
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Audio_Player{
	use Raw_Object;

	/**
	 * Token
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $token;

	/**
	 * Offset in miliseconds
	 *
	 * @since 1.0.0
	 *
	 * @var int
	 */
	protected $offset_in_miliseconds;

	/**
	 * Player activity
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $player_activity;

	/**
	 * Audio_Player constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Input from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->token = $object->token;
		$this->offset_in_miliseconds = $object->offsetInMilliseconds;
		$this->player_activity = $object->playerActivity;
	}

	/**
	 * Get token
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_token() {
		return $this->token;
	}

	/**
	 * Get Offset in Miliseconds
	 *
	 * @since 1.0.0
	 *
	 * @return int
	 */
	public function get_offset() {
		return $this->offset_in_miliseconds;
	}

	/**
	 * Get Player
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_player_activity() {
		return $this->player_activity;
	}
}