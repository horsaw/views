<?php

namespace Horsaw\Views;

use Closure;

class View {
	/**
	 * Holds the layout to be used.
	 *
	 * @access public
	 * @static
	 * 
	 * @var string
	 */
	public static $layout = '';

	/**
	 * Holds the sections.
	 *
	 * @access public
	 * @static
	 * 
	 * @var array
	 */
	public static $sections = [];

	/**
	 * Sets the layout to be used.
	 *
	 * @access public
	 * @static
	 * 
	 * @param  string $layout
	 * 
	 * @return void
	 */
	public static function extends( $layout ) {
		self::$layout = $layout;
	}

	/**
	 * Sets the content of a given section in the layout.
	 *
	 * @access public
	 * @static
	 *
	 * @param  string  $section
	 * @param  Closure $callback
	 * 
	 * @return void
	 */
	public static function section( $section, Closure $callback ) {
		if ( ! isset( self::$sections[ $section ] ) ) {
			self::$sections[ $section ] = [];
		}

		self::$sections[ $section ][] = [ 'function' => $callback ];
	}

	/**
	 * Loads the given section.
	 * 
	 * @param  [type] $section [description]
	 * 
	 * @return void
	 */
	public static function load( $section ) {
		if ( ! isset( self::$sections[ $section ] ) ) {
			return;
		}

		foreach ( self::$sections[ $section ] as $section_callback ) {
			call_user_func( $section_callback['function'] );
		}
	}
}