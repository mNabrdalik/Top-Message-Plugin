<?php

namespace PixelPath\TopMessagePlugin\Classes;

//check if SettingsPage class exist
if(!class_exists('SettingsPage')) {

    //create SettingsPage class
    class SettingsPage {

        private static $instance = null;

        public function __construct()
        {
            //add options page to admin Settings page
            add_action('admin_menu', array($this, 'create_settings_page'));
            //register inputs to set values
            add_action('admin_init', array($this, 'register_settings'));

        }

        //Singleton method to ensure only one instance
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        //callback function for add action hook admin menu 
        public function create_settings_page() {
            //add option page in Settings
            add_options_page(
                'Top Message Settings', 
                'Top Message', 
                'manage_options', 
                'top-msg-settings', 
                array($this, 'settings_page_html')
            );
        }

        //callback function for add action hook admin init 
        public function register_settings() {
            //register 4 variables: content, color, bgColor and isVisible
            register_setting('top-msg-settings-group', 'top_msg_content');
            register_setting('top-msg-settings-group', 'top_msg_bg_color');
            register_setting('top-msg-settings-group', 'top_msg_text_color');
            register_setting('top-msg-settings-group', 'top_msg_visible');
        }


        //options visible on admin panel
        public function settings_page_html() {
            ?>
            <div class="wrap">
                <h1>Top Message Settings</h1>
                <form method="post" action="options.php">
                    <?php settings_fields('top-msg-settings-group'); ?>
                    <?php do_settings_sections('top-msg-settings-group'); ?>
                    <table class="form-table">
                        <!-- is visible? -->
                        <tr valign="top">
                            <th scope="row">Visible Element</th>
                            <td>
                              <input type="radio" id="show" name="top_msg_visible" value="true" <?php echo esc_html(get_option('top_msg_visible')) === "true" ? "checked" : "" ?>>
                              <label for="html">Show</label><br>
                              <input type="radio" id="hide" name="top_msg_visible" value="false" <?php echo esc_html(get_option('top_msg_visible')) === "false" ? "checked" : "" ?>>
                              <label for="css">Hide</label><br>
                            </td>
                        </tr>
                        <!-- text content -->
                        <tr valign="top">
                            <th scope="row">Message Content</th>
                            <td><input type="text" name="top_msg_content" placeholder="Welcome text" value="<?php echo esc_attr(get_option('top_msg_content')); ?>" /></td>
                        </tr>
                        <!-- bg color -->
                        <tr valign="top">
                            <th scope="row">Background Color</th>
                            <td><input type="color" name="top_msg_bg_color" placeholder="#FFFFFF" value="<?php echo esc_attr(get_option('top_msg_bg_color')); ?>" /></td>
                        </tr>
                        <!-- text color -->
                        <tr valign="top">
                            <th scope="row">Text Color</th>
                            <td><input type="color" name="top_msg_text_color" placeholder="#000000" value="<?php echo esc_attr(get_option('top_msg_text_color')); ?>" /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
            <?php
        }
        
    }
}