<?php

require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/src/alexa-sdk.php';

require_once dirname( dirname(__FILE__ ) ) . '/data/test-skill-class.php';

require_once dirname(__FILE__ ) . '/phpunit-fallback.php';

require_once dirname(__FILE__ ) . '/alexa-testcase-class.php';

// disable xdebug backtrace
if ( function_exists( 'xdebug_disable' ) ) {
	xdebug_disable();
}