<?php
/**
 * Fluent Custom SMTP Define MU Action
 *
 * @wordpress-plugin
 * Plugin Name:      Fluent Custom SMTP Define MU Action
 * Description:      MU Action Plugin to add define to wp-configs.php or GridPane user-configs.php
 * Version:          0.0.1
 * Author:           Jordan Trask
 * License:          GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:      fluent-smtp-define
 */

# -- Variables
$ff_postmark_api="";
$gp_user_config=ABSPATH."../user-configs.php";

# -- Check for gripane ROOTDIR/../user-configs.php
if ( file_exists($gp_user_config) ) {
    error_log("Found GridPane user-configs.php - ".$gp_user_config);

    $id = "FLUENTMAIL_POSTMARK_API_KEY";
    $handle = fopen($gp_user_config, 'r');
    $valid = false;

    error_log("Checking $gp_user_config");
    while (($buffer = fgets($handle)) !== false) {
        error_log($buffer);
        if (strpos($buffer, $id) !== false) {
            error_log("matched!");
            $valid = true;
            fclose($handle);
            break; // Once you find the string, you should break out the loop.
        }
    }
    if ( $valid == false ) {
        error_log("Didn't find Fluent SMTP string");
        error_log("Appended Fluent Forms Postmark API Key");
        $handle = fopen($gp_user_config, 'a'); //opens file in append mode
        fwrite($handle, "\ndefine( 'FLUENTMAIL_POSTMARK_API_KEY', '".$ff_postmark_api."' );");
        fclose($handle);
        error_log("Removing ".ABSPATH."wp-content/mu-plugins/mu-fluent-smtp-define.php");
        unlink(ABSPATH."wp-content/mu-plugins/mu-fluent-smtp-define.php");
    } elseif ( $valid == true ) {
        error_log("Found Fluent SMTP string...exiting.");
    } else {
        error_log("Unknown failure");
    }
} else {

error_log("Couldn't find GridPane user-configs.php - ".$gp_user_config);

}