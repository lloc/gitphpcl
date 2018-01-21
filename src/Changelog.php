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

	/**
	 * @param array $lines
	 * @param int $pos
	 * @param array $add
	 *
	 * @return int
	 */
	public function insert( array $lines, int $pos, array $add = [] ): int {
		if ( ! empty ( $add ) ) {
			$lines = array_merge( $lines, $add );
		}

	    if ( $pos >= count( $this->lines ) - 1 ) {
		    $this->lines = array_merge( $this->lines, $lines );

		    return count( $this->lines ) - 1;
	    }

        $head = array_slice( $this->lines, 0, $pos );
        $tail = array_slice( $this->lines, $pos);

        $this->lines = array_merge( $head, $lines, $tail );

        return $pos + count( $lines );
	}

	/**
	 * @param string $filename
	 *
	 * @return bool
	 */
	public function save( string $filename ): bool {
		return file_put_contents( $filename, implode( '', $this->lines ) );
	}

}