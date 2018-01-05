<?php

namespace lloc\gitphpcl;

/**
 * Class ArrayOutput
 * @package lloc\changelog
 */
class ArrayOutput {

	/**
	 * @var string
	 */
	protected $cmd;

	/**
	 * @param string $cmd
	 */
	public function __construct( string $cmd ) {
		$this->cmd = $cmd;
	}

	/**
	 * @return array
	 */
	function get(): array {
		$output = shell_exec( $this->cmd );

		return (array) preg_split( "#[\r\n]+#", $output );
	}

}
