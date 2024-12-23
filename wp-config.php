<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cahavin' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'BfFUJ2FxsEKviMaEbRPqzGwAokmOPlLVaVhKEXgyKp6SpDpWh9EYL9QmC6mbgHeO' );
define( 'SECURE_AUTH_KEY',  'LpwWEyTwDiilVGqVVBYJYUJKrslPbzWgkBIpO8h6jSQ8q2bg4NwhENQ9zFCmLwk4' );
define( 'LOGGED_IN_KEY',    'Mg3HXuKEBjhNsHKHRITyMEBuO3dxKYrHPll1nxv9RUw6Llr765MHS26vxwomxtSN' );
define( 'NONCE_KEY',        'O7xshqBNzlgf1J5tNPPnBnsecC5eioW9k7YBWWKbpXc47FIW7k478flSvnamiprx' );
define( 'AUTH_SALT',        '17KzAAFZODdGpQymZYw30ugfpSPP7PMcUgDMu4WQYMtRxOmoPQzTUh21Io3juYVp' );
define( 'SECURE_AUTH_SALT', 'ty3juAk5wQHtJW0SfMc31smY9nCD15CMbO8BBCTAyOrPIQTUY1UXUAUk8iunR3TW' );
define( 'LOGGED_IN_SALT',   '7a2onOddvl9fU9UvKDETBMpYGxjlalOZxLC2GSNV0D2DYHN2OpvotHfrKm2oFIMC' );
define( 'NONCE_SALT',       '7J8l4OcS9HibkWsCElJbYBvgemnZM31UQzyCwp1ILKQjeIeAU1SxYaQMkC1TH5jP' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define('WP_DEBUG_LOG', true); // Guarda los errores en un archivo debug.log
define('WP_DEBUG_DISPLAY', true); // Muestra los errores en pantalla
@ini_set('display_errors', 1); // Asegúrate de que se muestren

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
