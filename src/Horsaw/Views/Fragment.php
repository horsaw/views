<?php

namespace Horsaw\Views;

class Fragment {
	/**
	 * Loads a fragment.
	 * 
	 * @param  string $fragment
	 * @param  array  $params
	 * 
	 * @return void
	 */
	public static function load( $fragment, $params = [] ) {
		$fragment_full_path = locate_template( "resources/views/fragments/{$fragment}.php" );

		if ( $fragment_full_path ) {
			extract( $params );

			include $fragment_full_path;
		}
	}
}