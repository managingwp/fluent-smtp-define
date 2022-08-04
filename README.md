# Fluent SMTP Define
Upon activation a file is placed into /wp-content/mu-plugins that looks for 'FLUENTMAIL_POSTMARK_API_KEY' defined in user-configs.php on GridPane.

## If not found
* It will add ```define( 'FLUENTMAIL_POSTMARK_API_KEY', '$ff_postmark_api' );``` to user-configs.php.
* It will delete itself from /wp-content/mu-plugins
* make sure to edit $ff_postmark_api to add your Postmark API.

## If found
* If found, it will delete itself from /wp-content/mu-plugins

# How to Use
* Clone this repository or download the zip.
* Edit ```$ff_postmark_api``` in ```mu-fluent-smtp-define.php```
* Repackage into a zip and upload to your WordPress site or add to GridPane bundles.

# Todo
* Figure out how to fully configure Fluent SMTP.
* Pull in Postmark API key via GridPanes sendgrid-wp-configs.php SMTP_PASS variable
* Support custom define so other providers can be used, which should be simple.
 