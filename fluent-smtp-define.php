<?php
/**
 * Fluent Custom SMTP Define
 *
 * @wordpress-plugin
 * Plugin Name:      Fluent Custom SMTP Define
 * Description:      Plugin to add define to wp-configs.php or GridPane user-configs.php
 * Version:          0.0.1
 * Author:           Jordan Trask
 * License:          GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:      fluent-smtp-define
 */
 
function fcsd_plugin_activated () {
    $source = plugin_dir_path( __FILE__ )."mu-fluent-smtp-define.php";
    $destination = ABSPATH."wp-content/mu-plugins/mu-fluent-smtp-define.php";
    if( !copy($source, $destination) ) { 
        error_log("File can't be copied!"); 
    } else { 
        error_log("File has been copied!"); 
    }
}
register_activation_hook(__FILE__,'fcsd_plugin_activated');