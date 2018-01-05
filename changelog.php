<?php

require_once __DIR__ . '/vendor/autoload.php';

use lloc\gitphpcl\{
	ArrayOutput, Tag, Logs
};

exec( 'git fetch --tags' );

$cmd = 'git tag -l --format="%(creatordate:iso8601)|%(refname:short)" | sort -r';
$arr = ( new ArrayOutput( $cmd ) )->get();

if ( count( $arr ) > 1 ) {
	list( $date, $name ) = explode( '|', $arr[0] );
	$currTag = new Tag( $name, $date );
	list( $date, $name ) = explode( '|', $arr[1] );
	$lastTag = new Tag( $name, $date );

	$cmd  = sprintf( 'git log %s...%s --pretty=oneline --abbrev-commit',
		$lastTag->get_name(), $currTag->get_name()
	);
	$arr  = ( new ArrayOutput( $cmd ) )->get();
	$logs = ( new Logs( '#(?<commitId>[a-z0-9]+) (?<type>[a-z]+)\((?<module>.+)\): (?<message>.+)#' ) )->add( $arr );

	printf( "## %s (%s)\n\n", $currTag->get_name(), $currTag->get_date() );

	$commits = $logs->get( 'feat' );
	if ( $commits ) {
		echo "### Features\n\n";

		foreach ( $commits as $c ) {
			printf( "* **%s:** %s (%s)\n", $c->module, $c->message, $c->commitId );
		}
	}

	$commits = $logs->get( 'fix' );
	if ( $commits ) {
		echo "### Bug Fixes\n\n";

		foreach ( $commits as $c ) {
			printf( "* **%s:** %s (%s)\n", $c->module, $c->message, $c->commitId );
		}
	}

}
