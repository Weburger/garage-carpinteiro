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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'garage-carpinteiro' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'zF:)VM|+3Dmy}FfKxpca~j]S*u,c@^?/PdT+wL3*{CXvgHMWHG:{T`l^ _L,]`lf' );
define( 'SECURE_AUTH_KEY',  '[:jpwQfk/oST^}ZwDd[b3.z]3Y2On6n7 1vn.w}@R!v06fd<{|0sy]Q%.BYw tjh' );
define( 'LOGGED_IN_KEY',    'uljCkB<dqaTCr7)D.|Ba[8_f61.Z-}Xglp A$z&8W}/f;{Rv(jn%!U(sd_A,ht`[' );
define( 'NONCE_KEY',        'ar$fRk`M9lQ.JE5qFWsJNz~?r>dgu&i l7[c0o=q7c:Tq/x1c[w66D@AhfOt6YaT' );
define( 'AUTH_SALT',        'kSR,7&PQmw!!tRD8oiG,T(fg  Ocqv ,FF)%=LQ][x6ZuA5{jRYMRmzEW8:y2f=}' );
define( 'SECURE_AUTH_SALT', 'P ]-(LGm+DE6JPng/@k+KEG1*dhT~;Y]xBB#D;eB;TBWN@<2dscY#45=lGGqZGtL' );
define( 'LOGGED_IN_SALT',   'Ov?y<PO/P)J:OC|/Tq@#!Pw|0tc}5k|0x{VT^qYJ;b4{F>mKKU]{!3S!T=B$i;-<' );
define( 'NONCE_SALT',       'tu;S?}EyiyQDb2[s4DCJ|Dv?kFh9r`v<Z 1.N!+{ u;W9=fMf3^PAiEaV}{9bLd/' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
