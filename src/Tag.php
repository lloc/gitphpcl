<?php

namespace lloc\gitphpcl;

/**
 * Class Tag
 * @package lloc\changelog
 */
class Tag {

	/**
	 * @var string $name
	 * @var string $date
	 */
	protected $name, $date;

	/**
	 * @param string $name
	 * @param string $date
	 */
	public function __construct( string $name, string $date ) {
		$this->name = $name;
		$this->date = new \DateTime( $date );
	}

	/**
	 * @param string $line
	 * @param string $delimiter
	 *
	 * @return Tag
	 */
	public static function init( string $line, $delimiter = '|' ) {
		list( $date, $name ) = explode( $delimiter, $line );

		return new self( $name, $date );
	}

	/**
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * @param string $format
	 *
	 * @return string
	 */
	public function get_date( string $format = 'Y-m-d' ): string {
		return $this->date->format( $format );
	}

}
