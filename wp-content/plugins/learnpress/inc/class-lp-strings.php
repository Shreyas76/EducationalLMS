<?php
/**
 * Translate strings
 */

/**
 * Backup $string variable if it is already defined elsewhere.
 */
if ( isset( $strings ) ) {
	$__strings = $strings;
}

if ( false === ( $strings = LP_Object_Cache::get( 'strings', 'learn-press' ) ) ) {

	$strings = array(
		'confirm-redo-quiz'       => __( 'Do you want to redo quiz "%s"?', 'learnpress' ),
		'confirm-complete-quiz'   => __( 'Do you want to complete quiz "%s"?', 'learnpress' ),
		'confirm-complete-lesson' => __( 'Do you want to complete lesson "%s"?', 'learnpress' ),
		'confirm-finish-course'   => __( 'Do you want to finish course "%s"?', 'learnpress' ),
		'confirm-retake-course'   => __( 'Do you want to retake course "%s"?', 'learnpress' ),
	);

	LP_Object_Cache::set( 'strings', $strings, 'learn-press' );
}

/**
 * Restore $string
 */
if ( isset( $__strings ) ) {
	$strings = $__strings;
}

/**
 * Class LP_Strings
 */
class LP_Strings {

	/**
	 * @since 3.3.0
	 *
	 * @var array
	 */
	protected static $strings = array();

	/**
	 * @since 3.2.0
	 */
	public static function load() {
		$strings = array();
		include_once "lp-strings.php";
		self::$strings = $strings;
	}

	/**
	 * @param string $str
	 * @param string $context
	 * @param string $args
	 *
	 * @return mixed|string
	 */
	public static function get( $str, $context = '', $args = '' ) {
		$string = $str;
		if ( $strings = self::$strings ) {
			if ( array_key_exists( $str, $strings ) ) {
				$texts = $strings[ $str ];

				if ( is_string( $texts ) ) {
					$string = $texts;
				} else if ( $context && array_key_exists( $context, $texts ) ) {
					$string = $texts[ $context ];
				} else {
					$string = reset( $texts );
				}
			}
		}

		return is_array( $args ) ? vsprintf( $string, $args ) : $string;
	}

	public static function esc_attr( $str, $context = '', $args = '' ) {
		return esc_attr( self::get( $str, $context, $args ) );
	}

	public static function esc_attr_e( $str, $context = '', $args = '' ) {
		esc_attr_e( self::get( $str, $context, $args ) );
	}

	public static function output( $str, $context = '', $args = '' ) {

	}
}

LP_Strings::load();