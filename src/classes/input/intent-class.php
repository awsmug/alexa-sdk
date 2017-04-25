<?php

namespace Alexa\Input;
use Alexa\Raw_Object;

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
	private $slots = array();

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
			$object_vars = get_object_vars(  $this->object->slots );

			foreach( $object_vars AS $object_var ) {
				$this->slots[ $object_var->name ] = $object_var->value;
			}
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
		return array_keys( $this->get_slots() );
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
		if( ! array_key_exists( $name, $this->get_slots() ) ) {
			return false;
		}
		return $this->slots[ $name ];
	}
}