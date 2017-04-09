<?php

namespace Alexa\Output;
use Alexa\Output_Object;
use Alexa\Exception;

/**
 * Class Output_Speech
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Output_Speech implements Output_Object {
	/**
	 * Type of output speech
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $type = 'PlainText';

	/**
	 * Text to speak
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $text;

	/**
	 * SSML Text to speek
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $ssml;

	/**
	 * Output_Speech constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {}

	/**
	 * Setting Output speech
	 *
	 * @since 1.0.0
	 *
	 * @param string $speech_type Value 'PlainText' or 'SSML'
	 * @param $content string Content to speak by alexa
	 */
	public function set( $speech_type, $content ) {
		$this->set_type( $speech_type );

		if( 'PlainText' === $speech_type ) {
			$this->set_text( $content );
		} else {
			$this->set_ssml( $content );
		}
	}

	/**
	 * Speech type
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Value 'PlainText' or 'SSML'
	 *
	 * @throws Exception
	 */
	public function set_type( $type ) {
		if( 'PlainText' !== $type && 'SSML' !== $type ) {
			throw new Exception( sprintf( 'Speech Type %s does not exist', $type ) );
		}

		$this->type = $type;
	}

	/**
	 * Get type of Output Speech
	 *
	 * @since 1.0.0
	 *
	 * @return string PlainText or SSML
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Setting text to speak by Alexa
	 *
	 * @since 1.0.0
	 *
	 * @param $text
	 */
	public function set_text( $text ) {
		$this->text = $text;
	}

	/**
	 * Get text
	 *
	 * @since 1.0.0
	 *
	 * @return bool|string $text False if empty or value which have been set
	 */
	public function get_text() {
		if( empty( $this->text ) ) {
			return false;
		}
		return $this->text;
	}

	/**
	 * Setting ssml text to speak by Alexa
	 *
	 * @since 1.0.0
	 *
	 * @param $text
	 */
	public function set_ssml( $ssml ) {
		$this->ssml = $ssml;
	}

	/**
	 * Get SSML content
	 *
	 * @since 1.0.0
	 *
	 * @return bool|string $ssml False if empty or value which have been set
	 */
	public function get_ssml() {
		if( empty( $this->ssml ) ) {
			return false;
		}
		return $this->ssml;
	}

	/**
	 * Is there any value set in Output_Speech
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function has_values() {
		if( empty( $this->ssml ) && empty( $this->text ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Getting Object content
	 *
	 * @since 1.0.0
	 *
	 * @return \StdClass $object
	 */
	public function get() {
		$object = new \StdClass;

		$object->type = $this->type;

		if( 'PlainText' === $this->type ) {
			$object->text = $this->text;
		} else {
			$object->ssml = $this->text;
		}

		return $object;
	}
}