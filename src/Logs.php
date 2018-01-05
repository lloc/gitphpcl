<?php

namespace lloc\gitphpcl;

/**
 * Class Logs
 * @package lloc\changelog
 */
class Logs {

	/**
	 * @var string $pattern
	 * @var array $logs
	 */
	protected $pattern, $logs = [];

	/**
	 * @param $pattern
	 */
	public function __construct( string $pattern ) {
		$this->pattern = $pattern;
	}

	/**
	 * @param array $arr
	 *
	 * @return self
	 */
	public function add( array $arr ): self {
		foreach ( $arr as $line ) {
			if ( preg_match( $this->pattern, $line, $match ) ) {
				$this->logs[ $match['type'] ][] = new Commit( $match );
			}
		}

		return $this;
	}

	/**
	 * @param $type
	 *
	 * @return array
	 */
	public function get( $type ) {
		$logs = $this->logs[ $type ] ?? [];

		usort( $logs, function ( $a, $b ) {
			return strcmp( $a->module . $a->message, $b->module . $b->message );
		} );

		return $logs;
	}

}
