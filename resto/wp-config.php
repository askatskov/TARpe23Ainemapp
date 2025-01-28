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
define( 'DB_NAME', 'd132388sd586127' );

/** Database username */
define( 'DB_USER', 'd132388sa533502' );

/** Database password */
define( 'DB_PASSWORD', 'j27ABvwkXW5CV5784' );

/** Database hostname */
define( 'DB_HOST', 'd132388.mysql.zonevs.eu' );

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
define('AUTH_KEY',         'Jo5uHOadFyX68gfCVfKcYQftEtpfiB0AXNMSR85TUtlFOJyN03i1ic76rbxGBpE8');
define('SECURE_AUTH_KEY',  'WtuQ3ZnqmCO2jo730SDUPhkr6DSyizGXb5Hnu443kQ5kxTL6BZGgEaSfrP4Es1nc');
define('LOGGED_IN_KEY',    'Apb7WmhrRzYeBrBJbqtFfot5HEPejfiAKppTEyneWGjgHwE97M4k9mu6Cicpwlg6');
define('NONCE_KEY',        'D4aThftjzQ3nMcp6sR18fjAeGI2lqFVAWy4cC5xR6H7f26JjLiAOmHeHdBBYNvsG');
define('AUTH_SALT',        'RowGnMsIgs5huGFc3wanS9MkRqk5XD5GzfMzeDzQGXgca0IZOS4XT3vQeX6st4FR');
define('SECURE_AUTH_SALT', 'o1vMABrqvQdp4YS7pnC73WqH3qNYN5u8Lqp6V2vBu3i3eTCWrEJ11O8QC3obZowI');
define('LOGGED_IN_SALT',   'hEbeDSDvdrOPp9j3VSJOrryuyIR5NljU5AruKKGEUHaABZLguppYXgMi9KU8G0gl');
define('NONCE_SALT',       'q7GPILVCaNMFlmDM1m8MHoRuI8dOrzgNp3UnRHlI9dnzGAahKtRsFkmjDQzNEbN4');

/**
 * Other customizations.
 */
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'jpnk_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );


define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'artjomskatskov23.thkit.ee' );
define( 'PATH_CURRENT_SITE', '/resto/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


