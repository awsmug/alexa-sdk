<?php

namespace Alexa\Input;
use Alexa\Raw_Object;

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
	 * Offset in milliseconds
	 *
	 * @since 1.0.0
	 *
	 * @var int
	 */
	protected $offset;

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
		$this->offset = $object->offsetInMilliseconds;
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
	 * Get Offset in milliseconds
	 *
	 * @since 1.0.0
	 *
	 * @return int
	 */
	public function get_offset() {
		return $this->offset;
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