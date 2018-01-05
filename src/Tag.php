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
