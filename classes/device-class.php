<?php

namespace Alexa;

/**
 * Class User
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Device {
	use Id;
	use Raw_Object;

	/**
	 * Permissions
	 *
	 * @since 1.0.0
	 *
	 * @var Permissions
	 */
	protected $permissions;

	/**
	 * User constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Data from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->id = $object->deviceId;
	}
}