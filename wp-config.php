<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'news');

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
define('AUTH_KEY',         '|w~qF h)H;%M6YKyeS!#}|~p(x/[sU_ `j^aZvt0ns~og.f?s>DwVL,;15f Bw[+');
define('SECURE_AUTH_KEY',  '3? ^%kcNhx}?0q5j[>YBV9Bx+9Pwqeo)d?~?,1GOI:Lz,9zRc-@ybQuN7rioo0[F');
define('LOGGED_IN_KEY',    'w7p2 &Bzv0jUzHT(IeB~TLf0%}-?/9_9nVV<.w#f$*k0NU{sEB2gpk +m%g[I<(b');
define('NONCE_KEY',        '+I|/4T+;p[]0=.reN}l@ub$10TNlcaZ:g$ O1YCB^J#|6PeMiIiOIw7CeB,w53)=');
define('AUTH_SALT',        '&cu`t*zD<.!!uo|g<|z].vZGI%DgiC&o?e)w6@9J_Z&#7Hf~U.OD.MaN>JsI5$ Z');
define('SECURE_AUTH_SALT', 'OD-C`J>b:9U2U tZVg1pl!8L{wiCngRf^(h|d We<,.Ft|+~`H(TaTHU+Q_|{Pid');
define('LOGGED_IN_SALT',   'Ov=f*}|:$Rv2ddVjd!58{OLT~(bRbM>j6QuSHv.:#3+P:l!CSK;RMP|FI,->(-!{');
define('NONCE_SALT',       'L=Z_t&qb%Sxm%5q~TQATMU7g:N@lMS|*9c7j8 %@^C>f!L?<4]5TX^6kkXpX:gOi');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
