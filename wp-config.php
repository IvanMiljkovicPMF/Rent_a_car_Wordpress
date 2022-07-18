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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'w<iyNO<ss9kJ03A@?:i}{sRKtRpl$xz4#HX n:]9swgwO4@OAV+%60L,C:R(P4l ' );
define( 'SECURE_AUTH_KEY',  'CkNr/v98Y3TR#Q#> WM2hAa/fL;Ja[/D,r%Gdum`_oOvACiT?>`L~I?;TI{P!ZOE' );
define( 'LOGGED_IN_KEY',    'X+gG)G)-Q:XuCeFL%mkTVmza<^)06jbCayCDCiiQ$3jp-h!~Pxh5&v|[`+&vI5x=' );
define( 'NONCE_KEY',        '&#32<cSG41yG~/0M;Cs]p|6%dqo>nu2B.!BB!en(JDtq1pm?6v@X|%ULKDm:%@~&' );
define( 'AUTH_SALT',        '>i&m`SHH7jp4SUsV9(17=w)K`f>`N}C_hJ_1xXsW*Sp^#I+sF8z%+:Gh7hZb%|N^' );
define( 'SECURE_AUTH_SALT', 'L;y{(wp0I`qGCCp:UV5]0_YA+L8?bT`Ec!n`NX#tWcb[Me4_$P|]mNd}+vZor3]!' );
define( 'LOGGED_IN_SALT',   'i*#mxs/ieQrt/~%<<To0tR_2$<ic/t&pC5^WE_Q|zO9W>[qYv}3E2Nr`W$rG?e`3' );
define( 'NONCE_SALT',       'b^u_8pq/p^b6g(5m+9<j`jf.,NS~$Vl^g0@^YS-%r.:#Kf%Ak;vZkV@Dw~GA{NZ4' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
