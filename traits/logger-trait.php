<?php

namespace Alexa;

/**
 * Class Logger
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
trait Logger {
	/**
	 * Log the date
	 *
	 * @since 1.0.0
	 *
	 * @var bool
	 */
	protected $log_date = true;

	/**
	 * Log the time
	 *
	 * @since 1.0.0
	 *
	 * @var bool
	 */
	protected $log_time = true;

	/**
	 * Dateformat
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $log_dateformat = 'Y-m-d';

	/**
	 * Timeformat
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $log_timeformat = 'H:i:s';

	/**
	 * Logfile
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $logfile = 'log.txt';

	/**
	 * Logging function
	 *
	 * @since 1.0.0
	 *
	 * @param $value
	 *
	 * @return int|bool $written
	 */
	public function log( $value ) {
		$content = '';
		if( $this->log_date ) {
			$content .= date( $this->log_dateformat, time() ) . ';' ;
		}
		if( $this->log_time ) {
			$content .= date( $this->log_timeformat, time() ) . ';' ;
		}
		$content .= print_r( $value, true );
		$file = fopen( $this->logfile, 'a' );
		$written = fputs( $file, print_r( $content, true ) . chr( 13 ) );
		fclose( $file );

		return $written;
	}

	/**
	 * Delete the Logfile
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	protected function delete_logfile() {
		if( ! file_exists( $this->logfile ) ) {
			return false;
		}

		return unlink( $this->logfile );
	}
}