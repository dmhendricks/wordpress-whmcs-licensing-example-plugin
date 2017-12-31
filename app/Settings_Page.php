<?php
namespace Licensing_Example;
/**
  * An class to create a settings page for the plugin using wordpress-settings-api-class
  *
  * @link https://github.com/tareq1988/wordpress-settings-api-class wordpress-settings-api-class
  * @since 1.0.0
  */
class Settings_Page {

  private $settings_api;
  private $config;
  private $section_id = 'options';

  function __construct( $args ) {

    $this->config = $args;
    $this->settings_api = new \WeDevs_Settings_API();
    $this->settings_fields = array();

    // Create a settings page using wordpress-settings-api-class (Settings > Settings API)
    add_action( 'admin_init', array( $this, 'wpsac_admin_init' ) );
    add_action( 'admin_menu', array( $this, 'wpsac_admin_menu' ) );

  }

  /**
    * Initialize wordpress-settings-api-class
    */
  public function wpsac_admin_init() {

    $this->settings_api->set_sections( $this->get_settings_sections() );
    $this->settings_api->set_fields( $this->get_settings_fields() );
    $this->settings_api->admin_init();

  }

  /**
    * Add menu link in WP Admin
    */
  public function wpsac_admin_menu() {
    add_options_page( __( 'Licensing Addon Example Settings', 'licensing-addon-example' ), $this->config['short_name'], 'manage_options', 'licensing-addon-example-settings', array( $this, 'create_wpsac_settings_page' ) );
  }

  /**
    * Retrieve configuration sections
    */
  public function get_settings_sections() {

    $sections = array(

      array(
        'id'    => $this->config['prefix'] . '_options',
        'title' => $this->config['short_name'] . ' ' . __( 'Settings', 'licensing-addon-example' )
      )
    );

    return $sections;
  }

  /**
   * Returns all the settings fields
   *
   * @return array Settings fields
   */
  public function get_settings_fields() {

    $settings_fields = array(
      $this->config['prefix'] . '_options' => array(
        array(
          'name'              => $this->config['prefix'] . '_license_key',
          'label'             => __( 'License Key', 'whmcs-licensing-example' ),
          'desc'              => __( 'Enter the license key that you were provided after purchase.', 'whmcs-licensing-example' ),
          'type'              => 'text'
        )
      )
    );

    return $settings_fields;

  }

  /**
    * Create a settings page using wordpress-settings-api-class.
    */
  public function create_wpsac_settings_page() {

    echo '<div class="wrap">';
    $this->settings_api->show_navigation();
    $this->settings_api->show_forms();
    echo '</div>';

  }

  private function prefix( $key = '', $after = '_' ) {
    return $this->config['prefix'] . $after . $key;
  }

}
