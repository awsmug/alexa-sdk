<?php

namespace Alexa;

/**
 * Class Intent
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Intent {
	use Raw_Object;

	/**
	 * Intent name
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Slots
	 *
	 * @since 1.0.0
	 *
	 * @var array $slots
	 */
	private $slots;

	/**
	 * Intent constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Input from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->name = $object->name;
	}

	/**
	 * Getting name of Intent
	 *
	 * @since 1.0.0
	 *
	 * @return string $name
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Getting Slots
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_slots() {
		if( empty( $this->slots ) ) {
			$this->slots = get_object_vars(  $this->object->slots );
		}

		return $this->slots;
	}

	/**
	 * Returning slot names
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_slot_names(){
		return array_keys( $this->slots );
	}

	/**
	 * Getting Slot value
	 *
	 * @since 1.0.0
	 *
	 * @param $name
	 *
	 * @return bool|string
	 */
	public function get_slot_value( $name ) {
		if( ! array_key_exists( $name, $this->slots ) ) {
			return false;
		}
		return $this->slots[ $name ]->value;
	}
}