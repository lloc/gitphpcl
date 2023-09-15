<?php

namespace lloc\gitphpcl;

/**
 * Class Logs
 * @package lloc\changelog
 */
class Logs {

	/**
	 * @var string
	 */
	protected string $pattern;

	/**
	 * @var array
	 */
	protected array $logs = [];

	/**
	 * @param string $pattern
	 */
	public function __construct( string $pattern ) {
		$this->pattern = $pattern;
	}

	/**
	 * @param array $arr
	 *
	 * @return Logs
	 */
	public function add( array $arr ): Logs {
		foreach ( $arr as $line ) {
			if ( preg_match( $this->pattern, $line, $match ) ) {
				$this->logs[ $match['type'] ][] = new Commit( $match );
			}
		}

		return $this;
	}

	/**
	 * @param string $type
	 *
	 * @return string[]
	 */
	public function get( string $type ): array {
		$logs = $this->logs[ $type ] ?? [];

		usort( $logs, function ( $a, $b ) {
			return strcmp( $a->module . $a->message, $b->module . $b->message );
		} );

		return $logs;
	}

}
