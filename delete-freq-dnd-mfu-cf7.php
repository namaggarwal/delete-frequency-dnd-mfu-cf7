<?php

	/**
	* Plugin Name: Delete Frequency - Drag and Drop Multiple File Upload - Contact Form 7
	* Plugin URI: https://naman.io
	* Description: This simple allows you to specify delete frequency in Drag and Drop plugin
	* Text Domain: delete-freq-dnd-mfu-cf7
	* Version: 1.0
	* Author: Naman Aggarwal
	* Author URI: http://naman.io
	* License: MIT
  **/

	/**  This protect the plugin file from direct access */
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

  /** Set plugin constant to true **/
	define( 'df_dnd_mfu_cf7', true );

	/**  Define plugin Version */
  define( 'df_dnd_mfu_cf7_version', '1.0' );

  define( 'df_dnd_mfu_cf7_directory', untrailingslashit( dirname( __FILE__ ) ) );

  require_once( df_dnd_mfu_cf7_directory .'/includes/df-dnd-mfu-cf7.php' );
  require_once( df_dnd_mfu_cf7_directory .'/includes/df-dnd-mfu-cf7-settings.php' );

  //run on deactivation of plugin
  register_deactivation_hook( __FILE__, array( 'DF_DND_MFU_CF7', 'deactivate' ) );

  $df_dnd_upload_cf7_plugin_obj = new DF_DND_MFU_CF7();

  // Trigger the settings page
  if (is_admin()) {
    $df_dnd_upload_cf7_plugin_obj_settings = new DF_DND_MFU_Settings();
  }