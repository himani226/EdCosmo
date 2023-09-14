<?php
namespace Mediavine\Grow;

/**
 * Class Critical_Styles
 * This class helps manage creating the critical css styles to be inserted inline in tools
 * @package Mediavine\Grow
 */
class Critical_Styles {

	/** @var null|Critical_Styles */
	private static $instance = null;

	/** @var bool Whether critical styles are active or not */
	private $is_active = false;

	/**
	 * Get the instance of the class
	 *
	 * @return Critical_Styles|null
	 */
	public static function get_instance() : Critical_Styles {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->init();
		}

		return self::$instance;
	}

	/**
	 * Init function in case it is needed in the future.
	 */
	public function init() : void {
		$settings  = Settings::get_setting( 'dpsp_settings' );
		$is_active = \Social_Pug::is_free() || ( $settings['inline_critical_css'] ?? '1' );
		$this->set_active( filter_var( $is_active, \FILTER_VALIDATE_BOOLEAN ) );
		if ( $is_active ) {
			add_filter( 'safe_style_css', [ __CLASS__, 'allowed_properties' ] );
		}
	}

	/**
	 * Set the is active state for the Critical CSS Singleton
	 *
	 * @param bool $active Active state to set
	 */
	private function set_active( bool $active = false ) : void {
		$this->is_active = boolval( $active );
	}

	/**
	 * Get Style attribute at a location
	 *
	 * @param string $slug Slug identifier for the element to get inline css for
	 * @param string $location Location that this is being called from
	 * @return string
	 */
	public static function get( string $slug, string $location = '' ) : string {
		$instance = self::get_instance();
		if ( ! $instance->is_active ) {
			return '';
		}
		$styles = apply_filters( 'mv_grow_critical_styles_' . $location, [], $slug );
		if ( ! is_array( $styles ) ) {
			return '';
		}
		$styles = esc_attr( join( ';', $styles ) );
		return empty( $styles ) ? '' : 'style="' . $styles . '"';
	}

	/**
	 * Set the instance of the class
	 *
	 * @since 2.16.0
	 * @param Critical_Styles|null $instance Current Instance of the Class
	 */
	public static function set_instance( ? Critical_Styles $instance ) : void {
		self::$instance = $instance;
	}

	/**
	 * @param mixed $styles Existing Allowed Properties
	 *
	 * @return mixed
	 */
	public static function allowed_properties( $styles ) {
		if ( ! is_array( $styles ) ) {
			return $styles;
		}
		$styles[] = 'position';
		$styles[] = 'float';
		$styles[] = 'right';
		$styles[] = 'left';
		return $styles;
	}


}
