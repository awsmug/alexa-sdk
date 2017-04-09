<?php

namespace Alexa\Input;
use Alexa\Exception;
use Alexa\Id;
use Alexa\Raw_Object;

/**
 * Class User
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class User {
	use Id;
	use Raw_Object;

	/**
	 * Access token
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $access_token = false;

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
	 * @param \stdClass $object User Data from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->id = $object->userId;

		if( property_exists( $object, 'accessToken') ) {
			$this->access_token = $object->accessToken;
		}
	}

	/**
	 * Get access token
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_access_token() {
		return $this->access_token;
	}

	/**
	 * Are there permissions
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function has_permissions() {
		if( ! property_exists( $this->object, 'permissions ' ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Returns User Object
	 *
	 * @since 1.0.0
	 *
	 * @return Permissions $permissions
	 *
	 * @throws Exception
	 */
	public function permissions() {
		if( empty( $this->permissions ) ) {
			if( ! property_exists( $this->object, 'permissions' ) ) {
				throw new Exception( 'There is no permission data in this request.' );
			}

			$this->permissions = new Permissions( $this->object->permissions );
		}

		return $this->permissions;
	}
}