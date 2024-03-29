<?php

namespace lloc\gitphpcl;

/**
 * Class Directories
 * @package lloc\gitphpcl
 */
class Directories {

	/**
	 * @var string $currentDir
	 */
	protected string $currentDir;

	/**
	 * @var string[] $path
	 */
	protected array $path = [];

	/**
	 * @param string $currentDir
	 */
	public function __construct( string $currentDir ) {
		$this->currentDir = realpath( $currentDir );
	}

	/**
	 * @param string[] $options
	 *
	 * @return Directories
	 */
	public static function init( array $options ): Directories {
		$obj = new self( getcwd() );

		$obj->add( dirname( $options['f'] ) );
		if ( isset( $options['p'] ) ) {
			foreach ( ( array ) $options['p'] as $path ) {
				$obj->add( $path );
			}
		}

		return $obj;
	}

	/**
	 * @param string $path
	 *
	 * @return Directories
	 */
	public function add( string $path ): Directories {
		$this->path[] = realpath( $path );

		return $this;
	}

	/**
	 * @return bool
	 */
	public function next(): bool {
		if ( empty( $this->path ) ) {
			chdir( $this->currentDir );

			return false;
		}

		$directory = array_shift( $this->path );

		return $directory == $this->currentDir || chdir( $directory );
	}

}