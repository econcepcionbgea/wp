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
define('DB_NAME', 'wp1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'mysql');

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
define('AUTH_KEY',         '6C)r$R8a`BU?/LA9f&lLaXM609MhKh-NDUylZ2&T> UYFU`Vb.QII(;Ayow~6%V{');
define('SECURE_AUTH_KEY',  '@en^](i%C.WISYvRs0l</,M(A4hQ:k)nG%I#@vvEO38 F EIUW-}*%l8rL]}O|$#');
define('LOGGED_IN_KEY',    '9R9d_1jB0aP}dTJ :rA$#|4BT?3GeREEw3zuz$#J0)bPGu)&[x3]/4:5:x,lMs-O');
define('NONCE_KEY',        '>|![%svKPkykBrn&!R?t6*}d?j:A)eb1[..seXRMIvfiZg]?.O11mxu|+,o!m=uJ');
define('AUTH_SALT',        ' @8>]58_>oiK,|~mDEPmlrpl*gsLleJX:?|Pv0oi.@,>R>TE]],.r[DZ5VGAK^6+');
define('SECURE_AUTH_SALT', 'xyhqr3)|y0}V?8t-3^#iOKI2+NKrni3p&(MH;;,()LYD`}|UOW:Pac8##]n/rvz5');
define('LOGGED_IN_SALT',   'S3F:%#2GL@X-F:b?Q#v&ed92axw%l$.>yBi/%%~F5=}z:M~}v04}508qnMA B-C3');
define('NONCE_SALT',       'f&9|d0;p_nGA&fj4&53yvP-Cu{( VTUJ^$&/-.8?|XjSc(j[;|{^$>Xg~^hb4%g-');

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
