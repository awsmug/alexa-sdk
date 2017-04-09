<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/src/alexa-sdk.php';

require_once dirname( dirname(__FILE__ ) ) . '/data/test-skill-class.php';

require_once dirname(__FILE__ ) . '/phpunit-fallback.php';

require_once dirname(__FILE__ ) . '/alexa-testcase-class.php';

// disable xdebug backtrace
if ( function_exists( 'xdebug_disable' ) ) {
	xdebug_disable();
}