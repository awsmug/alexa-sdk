<?php

namespace Alexa;

/**
 * Class Application
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Application {
	use Id;
	use Raw_Object;

	/**
	 * Application constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $object Application from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->id = $object->applicationId;
	}
}