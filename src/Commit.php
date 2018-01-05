<?php

namespace lloc\gitphpcl;

/**
 * Class Commit
 * @package lloc\changelog
 */
class Commit {

	/**
	 * @var string $type
	 * @var string $module
	 * @var string $message
	 * @var string $commitId
	 * @var string $format
	 */
	public $module, $message, $commitId;

	/**
	 * @param array $args
	 */
	public function __construct( array $args ) {
		$this->module   = $args['module'] ?? '';
		$this->message  = $args['message'] ?? '';
		$this->commitId = $args['commitId'] ?? '';
	}

}
