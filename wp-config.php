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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'edcosmo_db' );

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
define( 'AUTH_KEY',         'SF^;C|Td A9g3PTp7{T]Ej*a{(W)Pm2~v_.;K0Y^qf~FoV88O5q,NoU3kT*B$G1p' );
define( 'SECURE_AUTH_KEY',  ']j?B>vgZO@5 XeZt%SG0w=D%@eRg,VSXzW#ceUz.9R9{_U{ ^VOt#!G`(=^ywaf{' );
define( 'LOGGED_IN_KEY',    'wY7$z.>gnpo-*E-`^w8^bZ;B^v@$+_zw=1N+50?q@gYJ[KRt[W]k1|TF-#*=vy_x' );
define( 'NONCE_KEY',        'dd5v-*lI%s+7=bioybKC0a!Ij;I4#^P5a_g<,Agl)z]>^lew1:;wM>BYV/oQ$b><' );
define( 'AUTH_SALT',        '% 5t$Xn)g2tuJW)V)dZTWDXxyvtP|[Vs`PE;%Cjz<rPhNigy_kaUZ:k-Ue&/!aK4' );
define( 'SECURE_AUTH_SALT', 'gd`[IHX_.sa~!A!JXw@;vwO-IYa!#3A&;69qmW$!GxhqFkeBX.B_kqU0LoX+XU#5' );
define( 'LOGGED_IN_SALT',   'V5(?20$ I;$h!m|bMO3zP-x.S+M%k:l6GV-H$u~%=p&)hr}vd^u^=B,!$(XV^H6q' );
define( 'NONCE_SALT',       'DChO$CJ_B4f=rWzKl*X]pdPE!BD-LH*ZJ1)(a>hFX/0c+To1L;v^1A&v[>$FzYF3' );

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
