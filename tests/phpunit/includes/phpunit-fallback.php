<?php
use PHPUnit\Framework\TestCase;

if( ! class_exists( 'PHPUnit_Framework_TestCase' ) ) {
	class PHPUnit_Framework_TestCase extends TestCase {
		public function expectException( $exception ) {
			if( method_exists( $this, 'setExpectedException' ) ) {
				return $this->setExpectedException( $exception );
			}

			return parent::expectException( $exception );
		}
	}
}