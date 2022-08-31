<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-lodicoins' );

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
define( 'AUTH_KEY',         'I|t.lYR-G#rz463 @O0`{n9)Y}]Cz*L<s$D;4Mq[r!-TYq^ e#(:Tyl$xcgv!1`r' );
define( 'SECURE_AUTH_KEY',  '`Q{J$.>wi#B*RGs`$sSyxvc>~fRXw xmJ-Jgd}XQY4mxZlJRM D3IGndLWU|I|wA' );
define( 'LOGGED_IN_KEY',    ')s5RQk)jyH7=}!1_>x]|HYTY!($zR> e-wP^{NI6W>BnrxLIm6/!m,Exq`&g$uNG' );
define( 'NONCE_KEY',        '-vz.Tr`fB2##N.5N_B0i@FuM/42RF9DHz!MdiKe>drGrYMrj2kaJ9BOJX@.LHg6(' );
define( 'AUTH_SALT',        '!?}Kg&yp|6xM3i_Gg[F^MRovvnc@L*qDb2J_CLsRH**doa~Dfo}UYhVJ]<d,r!9O' );
define( 'SECURE_AUTH_SALT', 'mQA+ev83,(l=&>BYr63Cy;5gqqriPj:Y|JAZKPbLU6Tok&jPoPYpVcc2(ET:hg*,' );
define( 'LOGGED_IN_SALT',   'sdIvME{Z^!96m5S0zBO/60*w(#+/|]NAEqOELa_c|BB`8Jm}t_|SV-!9CQN)^m6B' );
define( 'NONCE_SALT',       'a*TLmFq9+:aA`V}CI7{=-6&3{duD`ScV0~o/Y3.g>Hq/$CF4mZ3+Fz9&sm5Zi: 0' );

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
