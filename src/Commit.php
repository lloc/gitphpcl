<?php

namespace lloc\gitphpcl;

/**
 * Class Commit
 * @package lloc\changelog
 */
class Commit {

	/**
	 * @var string
	 */
	public string $module;

	/**
	 * @var string
	 */
	public string $message;

	/**
	 * @var string
	 */
	public string $commitId;

	/**
	 * @param string[] $args
	 */
	public function __construct( array $args ) {
		$this->module   = $args['module'] ?? '';
		$this->message  = $args['message'] ?? '';
		$this->commitId = $args['commitId'] ?? '';
	}

}
