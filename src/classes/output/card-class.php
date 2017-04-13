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
class Card implements Output_Object {
	/**
	 * Type of card
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $type = 'Standard';

	/**
	 * Title of card
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $title;

	/**
	 * Content of Card
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $content;

	/**
	 * Text of Card
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $text;

	/**
	 * Small Image of Card
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $small_image_url;

	/**
	 * Large Image of Card
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $large_image_url;

	/**
	 * Output_Speech constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {}

	/**
	 * Speech type
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Simple, Standard or LinkAccount
	 *
	 * @throws Exception
	 */
	public function set_type( $type ) {
		if( 'Simple' !== $type && 'Standard' !== $type && 'LinkAccount' !== $type ) {
			throw new Exception( sprintf( 'Card Type %s does not exist', $type ) );
		}

		$this->type = $type;
	}

	/**
	 * Get type card
	 *
	 * @since 1.0.0
	 *
	 * @return string Simple, Standard or LinkAccount
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Setting title
	 *
	 * @since 1.0.0
	 *
	 * @param string $text
	 */
	public function set_title( $title ) {
		$this->title = $title;
	}

	/**
	 * Get title
	 *
	 * @since 1.0.0
	 *
	 * @return bool|string $text False if empty or value which have been set
	 */
	public function get_title() {
		if( empty( $this->title ) ) {
			return false;
		}
		return $this->title;
	}

	/**
	 * Set content
	 *
	 * @since 1.0.0
	 *
	 * @param string $content
	 */
	public function set_content( $content ) {
		$this->content = $content;
	}

	/**
	 * Get content
	 *
	 * @since 1.0.0
	 *
	 * @return bool|string $text False if empty or value which have been set
	 */
	public function get_content() {
		if( empty( $this->content ) ) {
			return false;
		}
		return $this->content;
	}

	/**
	 * Set text
	 *
	 * @since 1.0.0
	 *
	 * @param string $text
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
	 * Setting images
	 *
	 * @since 1.0.0
	 *
	 * @param string $small_image_url
	 * @param string $large_image_url
	 */
	public function set_images( $small_image_url = null, $large_image_url = null ) {
		if( ! empty( $small_image_url ) ) {
			$this->set_small_image( $small_image_url );
		}
		if( ! empty( $large_image_url ) ) {
			$this->set_large_image( $large_image_url );
		}
	}

	/**
	 * Set small image URL
	 *
	 * @since 1.0.0
	 *
	 * @param string $url
	 */
	public function set_small_image( $url ) {
		$this->small_image_url = $url;
	}

	/**
	 * Get small image URL
	 *
	 * @since 1.0.0
	 *
	 * @return bool|string
	 */
	public function get_small_image() {
		if( empty( $this->small_image_url ) ) {
			return false;
		}
		return $this->small_image_url;
	}

	/**
	 * Set large image URL
	 *
	 * @since 1.0.0
	 *
	 * @param string $url
	 */
	public function set_large_image( $url ) {
		$this->large_image_url = $url;
	}

	/**
	 * Get large image URL
	 *
	 * @since 1.0.0
	 *
	 * @return bool|string
	 */
	public function get_large_image() {
		if( empty( $this->large_image_url ) ) {
			return false;
		}
		return $this->large_image_url;
	}

	/**
	 * Is there any value set in Card
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function has_values() {
		if( empty( $this->title ) && empty( $this->content ) && empty( $this->text ) && empty( $this->small_image_url ) && empty( $this->large_image_url ) ) {
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

		if( ! empty( $this->title ) ) {
			$object->title = $this->title;
		}

		if( ! empty( $this->content ) ) {
			$object->content = $this->content;
		}

		if( ! empty( $this->text ) ) {
			$object->text = $this->text;
		}

		if( ! empty( $this->small_image_url ) ) {
			if( ! property_exists( $object, 'image' )  ) $object->image = new \stdClass();
			$object->image->smallImageUrl = $this->small_image_url;
		}

		if( ! empty( $this->large_image_url ) ) {
			if( ! property_exists( $object, 'image' )  ) $object->image = new \stdClass();
			$object->image->largeImageUrl = $this->large_image_url;
		}

		return $object;
	}
}