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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '7nbAWy$2O/&@,1=wiWAP(lEUN~cTZcM]E XzD4piqyD9hB1LtR2{(vwvW99-;g]e' );
define( 'SECURE_AUTH_KEY',  'F&glISEVD>/S.. )jQ-[5Uax6|Ia[lN*vnoe`wq[zL3,[b}7P,H;8,h,h_)at/f3' );
define( 'LOGGED_IN_KEY',    'cj-GC>M+9%otT|xyX@e6-@7@U#92<=@m`W&LVE(n1hmn&1tGxu1)}J`s;QX_!O2e' );
define( 'NONCE_KEY',        'V;DbA80p*>$8+STO_+qMkP2;hM<6V+~[M1B0o6n7lYlB=Uxei?[EB5|/oc8<RN/3' );
define( 'AUTH_SALT',        'Jadz[6ZLueP]8vXp*(<,^CER9So} /tGYF`&{2=f!`!><k=JDKR/|P}i[Z|#Ax5^' );
define( 'SECURE_AUTH_SALT', 'v#f;SH$TnFhhFAC~^%W:a/({0gk&sb@y[7+t}B<b%=j+U=O.T3EU|Y=0.H&F5a/e' );
define( 'LOGGED_IN_SALT',   ';nUh-Ioz!}e)ta/f,@ct#iEek[N!@L1$<N#_+~yx4s$Ym*H?=W(zk6d>q+U,xs.f' );
define( 'NONCE_SALT',       'i>#C#;6am4~7@8m7+f,x5b^O5ei.Q /H,HH!H=~4`sO}+Bur$]0Cg$oB[dFJgi B' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
