<?php
use PHPUnit\Framework\TestCase;

if( ! class_exists( 'PHPUnit_Framework_TestCase' ) ) {
	class PHPUnit_Framework_TestCase  extends TestCase {
		function expectException( $exception ) {
			if( method_exists( $this, 'setExpectedException' ) ) {
				return $this->setExpectedException( $exception );
			} else {
				return parent::expectException( $exception );
			}
		}
	}
}