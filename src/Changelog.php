<?php

namespace lloc\gitphpcl;

/**
 * Class Changelog
 * @package lloc\gitphpcl
 */
class Changelog {

	/**
	 * @var array
	 */
	protected $lines = [];

	/**
	 * @param string $filename
	 */
	public function __construct( string $filename ) {
		$this->lines = file( $filename ) ?? [];
	}

	/**
	 * @return bool|int
	 */
	public function firstpos( $needle ) {
		$alen = count( $this->lines );
		$slen = strlen( $needle );

		for ( $i = 0; $i < $alen; $i++ ) {
			$str = trim( $this->lines[ $i ] );
			if ( $needle == substr( $str, 0, $slen ) ) {
				return $i;
			}
		}

		return false;
	}

	/**
	 * @param int $index
	 *
	 * @return string
	 */
	public function getpos( int $index ): string {
		return trim( $this->lines[ $index ] );
	}

	/**
	 * @param int $index
	 * @param string $str
	 *
	 * @return bool
	 */
	public function compare( int $index, string $str ): bool {
		return $str === $this->getpos( $index );
	}

}