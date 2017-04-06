<?php

namespace Alexa;

/**
 * Class Output_Speech
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Card{
	/**
	 * Type of card
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $type;

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
	 * Setting up Card
	 *
	 * @since 1.0.0
	 *
	 * @param string $card_type Types 'Simple', 'Standard' or 'LinkAccount'
	 * @param string $title Title of Card
	 * @param string $content Content of Card
	 * @param string $text Text of Card
	 *
	 * @param $content Content to speak by alexa
	 */
	public function set( $card_type, $title = false, $content = false, $text = false ) {
		$this->set_type( $card_type );

	}

	/**
	 * Speech type
	 *
	 * @since 1.0.0
	 *
	 * @param string $type
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
	 * Setting text of Card
	 *
	 * @since 1.0.0
	 *
	 * @param string $text
	 */
	public function set_title( $title ) {
		$this->title = $title;
	}

	/**
	 * Setting content of Card
	 *
	 * @since 1.0.0
	 *
	 * @param string $content
	 */
	public function set_content( $content ) {
		$this->content = $content;
	}

	/**
	 * Setting text of Card
	 *
	 * @since 1.0.0
	 *
	 * @param string $text
	 */
	public function set_text( $text ) {
		$this->text = $text;
	}

	/**
	 * Setting ssml text to speak by Alexa
	 *
	 * @since 1.0.0
	 *
	 * @param $text
	 */
	public function set_image( $small_image_url = false, $large_image_url = false ) {
		if( ! empty( $small_image_url ) ) {
			$this->small_image_url = $small_image_url;
		}
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

		if( ! empty( $this->title ) ) {
			$object->title = $this->title;
		}
		if( ! empty( $this->content ) ) {
			$object->content = $this->content;
		}
		if( ! empty( $this->text ) ) {
			$object->text = $this->text;
		}

		if( ! empty( $this->small_image_url ) && ! empty( $this->large_image_url ) ) {
			$object->image = new \StdClass;

			if( ! empty( $this->small_image_url ) ) {
				$object->image->smallImageUrl = $this->small_image_url;
			}

			if( ! empty( $this->large_image_url ) ) {
				$object->image->largeImageUrl = $this->large_image_url;
			}
		}

		return $object;
	}
}