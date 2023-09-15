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
	protected string $cmd;

	/**
	 * @param string $cmd
	 */
	public function __construct( string $cmd ) {
		$this->cmd = $cmd;
	}

	/**
	 * @return string[]
	 */
	function get(): array {
		$result = shell_exec( $this->cmd );
		$arr    = preg_split(  "#[\r\n]+#", $result );

		return false === $arr ? [] : array_filter( $arr );
	}

}
