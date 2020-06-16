<?php

class DF_DND_MFU_Settings
{
  private $options;

  public function __construct()
  {
    add_action('admin_menu', array($this, 'add_plugin_page'));
    add_action('admin_init', array($this, 'page_init'));
  }

  /**
   * Add options page
   */
  public function add_plugin_page()
  {
    add_options_page(
      'Delete Frequency - Drag and Drop - Multi File Upload - Contact Form 7 Settings',
      'Delete Frequency-DnD-CF7',
      'administrator',
      'df-dnd-mfu-cf7-settings',
      array($this, 'create_admin_page')
    );
  }

  /**
   * Options page callback
   */
  public function create_admin_page()
  {
    // Set class property
    $this->options = get_option('df_dnd_mfu_cf7_settings_options');
?>
    <div class="wrap">
      <h1>Delete File - Drag and Drop - Multi File Upload - Contact Form 7 Settings</h1>
      <form method="post" action="options.php">
        <?php
        // This prints out all hidden setting fields
        settings_fields('df_dnd_mfu_cf7_settings_options_group');
        do_settings_sections('df-dnd-mfu-cf7-settings');
        submit_button();
        ?>
      </form>
    </div>
<?php
  }

  /**
   * Register and add settings
   */
  public function page_init()
  {
    register_setting(
      'df_dnd_mfu_cf7_settings_options_group', // Option group
      'df_dnd_mfu_cf7_settings_options', // Option name
      array($this, 'sanitize') // Sanitize
    );

    add_settings_section(
      'df_dnd_mfu_cf7_settings_options_group_section', // ID
      '', // Title
      array($this, 'print_section_info'), // Callback
      'df-dnd-mfu-cf7-settings' // Page
    );

    add_settings_field(
      'delete_frequency', // ID
      'Delete Frequency (in Seconds)', // Title
      array($this, 'delete_frequency_callback'), // Callback
      'df-dnd-mfu-cf7-settings', // Page
      'df_dnd_mfu_cf7_settings_options_group_section' // Section
    );
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function sanitize($input)
  {
    $new_input = array();
    if (isset($input['delete_frequency']))
      $new_input['delete_frequency'] = sanitize_text_field($input['delete_frequency']);

    return $new_input;
  }

  /**
   * Print the Section text
   */
  public function print_section_info()
  {
    print '';
  }

  public function delete_frequency_callback()
  {
    printf(
      '<input type="number" id="delete_frequency" name="df_dnd_mfu_cf7_settings_options[delete_frequency]" value="%s" />',
      isset($this->options['delete_frequency']) ? esc_attr($this->options['delete_frequency']) : '3600'
    );
  }
}
