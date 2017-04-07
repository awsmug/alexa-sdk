<?php

namespace Alexa;

trait Id{
	/**
	 * ID
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $id;

	/**
	 * Getting ID
	 *
	 * @since 1.0.0
	 *
	 * @return string $id
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Comparing string with actual id
	 *
	 * @since 1.0.0
	 *
	 * @param string $string
	 *
	 * @return bool
	 */
	public function id_equals( $string ) {
		return $this->id === $string;
	}
}