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
$ff_postmark_api=""; # Enter your postmark API.
$gp_user_config=ABSPATH."../user-configs.php";

# -- Functions
function fcsd_remove_mu () {
        fcsd_error("Removing ".ABSPATH."wp-content/mu-plugins/mu-fluent-smtp-define.php");
        unlink(ABSPATH."wp-content/mu-plugins/mu-fluent-smtp-define.php");
}

function fcsd_error ($text) {
    error_log("FCSD - ".$text);
}

function fcsd_check_postmark_define ($file) {
    $id = "FLUENTMAIL_POSTMARK_API_KEY";
    $handle = fopen($file, 'r');
    $valid = false;

    fcsd_error("Checking $file");
    while (($buffer = fgets($handle)) !== false) {
        fcsd_error($buffer);
        if (strpos($buffer, $id) !== false) {
            fcsd_error("FCSD - Matched!");
            $valid = true;
            fclose($handle);
            break; // Once you find the string, you should break out the loop.
        }
    }
    return $valid;
}

function fcsd_add_postmark_define ($file, $api_key) {
        $handle = fopen($file, 'a'); //opens file in append mode
        fwrite($handle, "\ndefine( 'FLUENTMAIL_POSTMARK_API_KEY', '".$api_key."' );");
        fclose($handle);
}

# -- Check for gripane ROOTDIR/../user-configs.php
if ( file_exists($gp_user_config) ) {
    fcsd_error("Found GridPane user-configs.php - ".$gp_user_config);

    $valid = fcsd_check_postmark_define($gp_user_config);
    fcsd_error("$valid =" . $valid );

    if ( $valid == false ) {
        fcsd_error("Didn't find Fluent SMTP string");
        fcsd_error("Appended Fluent Forms Postmark API Key");
        fcsd_add_postmark_define($gp_user_config,$ff_postmark_api);        
        fcsd_remove_mu();
    } elseif ( $valid == true ) {
        fcsd_error("Found Fluent SMTP string...exiting.");
        fcsd_remove_mu();
    } else {
        fcsd_error("Unknown failure");
    }
} else {

fcsd_error("Couldn't find GridPane user-configs.php - ".$gp_user_config);

}
