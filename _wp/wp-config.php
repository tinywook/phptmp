<?php

 define('DB_NAME', 'wordpress');
 define('DB_USER', 'root');
 define('DB_PASSWORD', 'wpdbpassword');
 define('DB_HOST', 'mysql');
 define('DB_CHARSET', 'utf8');
 define('DB_COLLATE', '');

 // remove for production
 // alows local file access for dev
 define('FS_METHOD', 'direct');


define('AUTH_KEY',         '5797bbc6ee21a74961f6a724e4a49f4a382d92cc');
define('SECURE_AUTH_KEY',  '1849dc19c5bd7f3d7633e6658b2defe0d9fb6202');
define('LOGGED_IN_KEY',    '721b9a102f801490772afcfdeb592cb9d42c0eec');
define('NONCE_KEY',        'aa572a681150c9568b9ea5a4612fc244dfcdfbd9');
define('AUTH_SALT',        'd22d85e3cbf6ae4ce8e9def3bab209fc5078e74e');
define('SECURE_AUTH_SALT', 'f167489e3e9d132a86f233a30e91ca2a4ad321e9');
define('LOGGED_IN_SALT',   'c89321cd0e782d2ae41ed1bb4b3c8735b6445b6c');
define('NONCE_SALT',       'bf04a7e928aa09ee25b5d5632eaf2ac7e7738b42');


$table_prefix  = 'wp_';

define('WP_DEBUG', false);

// If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
