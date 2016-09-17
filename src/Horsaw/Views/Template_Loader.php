<?php

namespace Horsaw\Views;

class Template_Loader {
	/**
	 * The Main Instance.
	 *
	 * @access protected
	 * @static
	 *
	 * @var \Horsaw\Views\Template_Loader
	 */
	protected static $instance = null;

	/**
	 * Original WordPress template.
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $original_template = '';

	/**
	 * Constructor.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function __construct() {
	}

	/**
	 * Returns the Main Instance.
	 *
	 * @access public
	 * @static
	 *
	 * @return \Horsaw\Views\Template_Loader
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Stores the original template to load.
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function set_original_template( $template ) {
		$this->original_template = $template;
	}

	public function render() {
		$template = str_replace( get_stylesheet_directory() . '/', '', $this->original_template );

		if ( $view_path = locate_template( "resources/views/{$template}" ) ) {
			include $view_path;

			if ( View::$layout ) {
				include locate_template( 'resources/views/layouts/' . View::$layout . '.php' );
			}
		} else {
			include $this->original_template;
		}
	}
}