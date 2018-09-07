<?php

/**
 * Plugin Name: WP Scripts and Style console debug
 * Plugin URI: https://github.com/alexmoise/Wp-Scripts-and-Styles-console-debug
 * GitHub Plugin URI: https://github.com/alexmoise/Wp-Scripts-and-Styles-console-debug
 * Description: A simple plugin to quickly output all WordPress styles and scripts in browser console, for debugging purposes. It shows handle and filename, and for JSs the location (header or footer). 
 * Version: 1.0.0
 * Author: Alex Moise
 * Author URI: https://moise.pro
 */

// Show SCRIPTS in browser console, for debugging
add_action( 'wp_footer', 'motils_console_log_scripts' );
function motils_console_log_scripts() {
	global $wp_scripts; $obno = 0;
	echo "\r\n <script type='text/javascript'> \r\n /* <![CDATA[ */ \r\n ";
		echo "jQuery(document).ready(function() {\r\n"; 
		echo "console.log('SCRIPTS:');\r\n";
		foreach( $wp_scripts->queue as $handle ) {
			$obno ++;
			$obj = $wp_scripts->registered [$handle]; $filename = basename($obj->src);
			if( in_array( $handle, $wp_scripts->in_footer ) ) {$is_in_footer = '(in footer)';} else {$is_in_footer = '(in HEADER)';}
			echo "console.log('".$obno." ".$is_in_footer." ".$handle." <".$filename.">');\r\n";
			unset($is_in_footer);
		}
		echo "\r\n});";
	echo "\r\n /* ]]> */ \r\n </script> \r\n ";
}

// Show STYLES in browser console, for debugging
add_action( 'wp_footer', 'motils_console_log_styles' );
function motils_console_log_styles() {
	global $wp_styles; $obno = 0;
	echo "\r\n <script type='text/javascript'> \r\n /* <![CDATA[ */ \r\n ";
		echo "jQuery(document).ready(function() {\r\n"; 
		echo "console.log('STYLES:');\r\n";
		foreach( $wp_styles->queue as $handle ) {
			$obno ++;
			$obj = $wp_styles->registered [$handle]; $filename = basename($obj->src);
			echo "console.log('".$obno." ".$handle." <".$filename.">');\r\n";
		}
		echo "\r\n});";
	echo "\r\n /* ]]> */ \r\n </script> \r\n ";
}

?>
