<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Licensing Addon Example Plugin
 * Plugin URI:        https://github.com/dmhendricks/wordpress-whmcs-licensing-example-plugin/
 * Description:       An example plugin for validating license keys via the WHMCS Licensing Addon
 * Version:           1.0.0
 * Author:            Daniel M. Hendricks
 * Author URI:        https://www.danhendricks.com
 * License:           GPL-2.0
 * License URI:       https://opensource.org/licenses/GPL-2.0
 * Text Domain: 			licensing-addon-example
 * Domain Path: 			languages
 */

/*	Copyright 2018	  Daniel M. Hendricks (https://www.danhendricks.com/)

		This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if( !defined( 'ABSPATH' ) ) die();
require( __DIR__ . '/vendor/autoload.php' );
require( __DIR__ . '/app/Settings_Page.php' );

class Licensing_Addon_Example_Plugin {

  function __construct() {

    // Validate license
    $license_check = new \WordPress_ToolKit\Licensing\WHMCS_License( __DIR__ . '/plugin.json', array( 'plugin' => array( 'path' => __DIR__ ) ) );

    $result = $license_check->validate( $this->get_plugin_option( $license_check->get_config( 'prefix' ) . '_license_key', $license_check->get_config( 'prefix' ) . '_options' ), get_option( $license_check->get_config( 'prefix' ) . '_local_key' ) );
    if( isset( $result['remotecheck'] ) ) update_option( $license_check->get_config( 'prefix' ) . '_local_key', isset( $result['localkey'] ) ? $result['localkey'] : '' );

    // Load settings page
    new \Licensing_Example\Settings_Page( $license_check->get_config() );

    // Display license notice, if invalid
    if( $result['status'] != 'Active' ) {
      $this->show_admin_notice( $result['status'] );
      return;
    }

    // Run plugin logic - in this example, we'll create a [hello_world] shortcode
    if ( ! shortcode_exists( 'hello_world' ) ) {
        add_shortcode( 'hello_world', array( $this, 'hello_world_shortcode' ) );
    }
  }

  /**
    * Get plugin option, with object caching (if available).
    *
    * @param string $key The name of the option key
    * @return mixed The value of specified option key
    * @link https://github.com/tareq1988/wordpress-settings-api-class WPSAC options
    */
  private function get_plugin_option( $key, $group, $cache = true ) {

    $options = get_option( $group );
    return isset( $options[ $key ] ) ? $options[ $key ] : null;

  }

  /**
    * Display admin notice on license check failure
    */
  private function show_admin_notice( $status ) {
    $class = 'notice notice-error';
  	$message = sprintf( __( 'Invalid license. Response: %s', 'licensing-addon-example' ), $status );

  	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
  }

  /**
    * Create a simple [hello_world] shortcode.
    */
  public function hello_world_shortcode() {
    return "Hello World!";
  }

}

new Licensing_Addon_Example_Plugin();
