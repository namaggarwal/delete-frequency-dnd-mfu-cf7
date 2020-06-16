<?php

if (!defined('ABSPATH') || !defined('df_dnd_mfu_cf7')) {
  exit;
}



class DF_DND_MFU_CF7 {

  function __construct()
  {
    // Filter to modify the time
    add_filter('dnd_cf7_auto_delete_files', array($this, 'modify_delete_file_time'));
  }

  public function modify_delete_file_time($seconds) {
    $options = get_option('df_dnd_mfu_cf7_settings_options', '');
    $time_in_seconds = (is_array($options) && isset($options['delete_frequency'])) ? $options['delete_frequency']: $seconds;
    return $time_in_seconds;
  }

  public static function deactivate() {
    delete_option('df_dnd_mfu_cf7_settings_options');
  }
}
