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
define( 'DB_NAME', 'd132388sd582091' );

/** Database username */
define( 'DB_USER', 'd132388sa529680' );

/** Database password */
define( 'DB_PASSWORD', 'M56c9UKime9QHB658' );

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
define('AUTH_KEY',         'zXCbNtwCRAtYKYTdNyOAfSiTiklj1NOYDkQlEZiUS6G8lRBDODjamMN1KnepJ1yI');
define('SECURE_AUTH_KEY',  'uQNmQiePnbUlXkQ1JkOEJBJjFZv6mmxUnyhe0MSBOwmgfvssDejdEyT37NQae5SM');
define('LOGGED_IN_KEY',    'a0gVrkSjMLfeYNO2xOoN3gZ6Tcxid88Qe5ibNm8buQhfr8xGycRbDk5Tss6sxkK7');
define('NONCE_KEY',        'HKH4Id7uXLy9M0gvDF5XTIqJoD3O5nQscjZSlMZH4ROYSIk1I2wp7jQSUD0Chzsg');
define('AUTH_SALT',        'ufSpU1Vbp4Suipqs3Xgr7xRE0aZWx2zWXbWcYMd7ar0wmb2Psq2VXSEtGMH5mIqC');
define('SECURE_AUTH_SALT', 'HiPfd5zEYvy3sRAdywzKyNBvNyGDWJUUrk5dOuFBNknE3y7UEXlM4Vxzj3gdh9dF');
define('LOGGED_IN_SALT',   'hYzPEbqEEHNVLtGiKwA6yR0vJkk326EAlIIkv2t26JFVPUFSRzgqa8qMpIuXZ3Ly');
define('NONCE_SALT',       '06N3d8meBJ78K5tKamNVBc94iRoARG915IYqJgmbw1N8Noq7TKxrzvINsGjTi5WQ');

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
$table_prefix = 't4dt_';

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
