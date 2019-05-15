<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'systemadmin');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '50::rU4OKg]Cbex;XX4$~W/(xqi4_Z 6(tp~uA7fTAhH%wh?AvYKJ-gCl{8dyN)a');
define('SECURE_AUTH_KEY',  'DA3b=Xzq0[=}W5<j*9W_sN0Tb?H^z4B5d&5XXY4N=;Bz.-OJa2,r3+?EO,KvZ+Z>');
define('LOGGED_IN_KEY',    ':y:u.<$1Yl!u6rIr&`<#AuX@1h|E(w?_J.kV=6N<)OZ[j<gqJUg|4&UEa*{aZ0;f');
define('NONCE_KEY',        'R_$Ne KJ{I.>5*bRTw/qCyQ!Y,nq.$:w|P/KxG5LASZ|T[~2> BtdRIj5i|U<6nN');
define('AUTH_SALT',        '|~DV.Xgroo<bF_r8U.2**zZZ44vuBwbt1?P4`ym/B&z!VG:hwo=PeQkN)E :&.;F');
define('SECURE_AUTH_SALT', 'BVbik>yr]c}M.Lni+nNn:EpEGG8rw,=]KsxuWdQ),0dY^%wd[<~-ELet]mdPTfRa');
define('LOGGED_IN_SALT',   'Gdx,g4*y[){dg&VaD=m6 qf?>m^>|`{Jv^!f2?wWnT+tCn{K3ypFuDMUfMw,lVGe');
define('NONCE_SALT',       'H(; YA_I|KF88DMi+_mT(l$JGHQ3nyH*P;,[XM=<`RO&shm]7Ff{C6OVzgvI^g7H');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
