<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}


define('AUTH_KEY',         'Ac233HG8NXdzJ+Ak1mzujmkVvjrNx4KfsIjE4Nx6NhdAG432fJ1jlDScPaO2W1nLOLaO87fKHram0bATkfcQPw==');
define('SECURE_AUTH_KEY',  'g/ui1OXM/OY8Ivzsl5CjT1mURd4L2oCkYX+FTLl9TDijCzz4V1fIHDzxOggbRZmZhxTDrzKa7oOvuRm0vGNOWA==');
define('LOGGED_IN_KEY',    'upoTCXYlLXyPQ73fuQ2Ny9HJEUaSzIPCMSDg2QD6FkFbzkpR+8c1VeAsucmBQOeF4J0KMzYwXKQijxXXjBP1Kw==');
define('NONCE_KEY',        'D0pTDvgbXOwwGh5mi21Q/lU5FMIGFG8D5Q4DZYdysr6kveHvIlt5ZwMDzyFidNtsFN9A0BPmmuW/i2wzwhtOZQ==');
define('AUTH_SALT',        'teM9nmnXPI7OcekQo6jOD1ZL54U/IxKCzgHM3qsy2c38TLt5B4zEm1r4NQ4U4sVDCCgNUeZ01bAktfqkYEUY/g==');
define('SECURE_AUTH_SALT', 'm+RXfJGbSlivSG/5gajkrO1orpbcNQIbwn8XA0qbLfKkKnVbR3gnBG9UPQwMewxLhvNxqYW38HQBwMqJ9Fs6Ww==');
define('LOGGED_IN_SALT',   'DlMhFbJjNu4nHu19E4YveVNR/+yWHNycNqjFFm4/Rvbb/EiXIKcha0nuqS0KV7P2XKRNHRwm0vvnPq0vigHfKg==');
define('NONCE_SALT',       'gbqIE34JciEh48Q7IgYO/lbACshCBbZVfVELXLZCYPO87s7nQ4YEwUaolJcYwuO5U0Is3xd/NfejxTKdXtUwSQ==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
