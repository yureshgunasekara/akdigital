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
define( 'DB_NAME', 'awsstart_akdig' );

/** Database username */
define( 'DB_USER', 'awsstart_akdig' );

/** Database password */
define( 'DB_PASSWORD', '4TkZT7Yxp4Kn99x6Tzed' );

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
define( 'AUTH_KEY',         'F<8:r-TWwI%tM~YA7V/S62|k=,#$nAbfel,0k4KEPNDR+{yS$a,Bpg $p|4qQ(KN' );
define( 'SECURE_AUTH_KEY',  '(}>3=ut4A~91(K8vt.RXe4Y&I)D0]MqMI8RIS Yo0H/7I4Am3np`GsKMqcQCXrFf' );
define( 'LOGGED_IN_KEY',    '1Oj[ C>cBXRSz>Xg?K<_M8/V3a/*%4N;57:*6Ut>H)|kJ*/M!,7@{>3HN0,NSz]{' );
define( 'NONCE_KEY',        'O~+;)<ojUpMS9=@6~[bc(OQ`k;1^_*zq_I3[T?wodP3HoF=Rx[Tyn9n:*CUP9Yku' );
define( 'AUTH_SALT',        'BZ81moc(LN^#1{NV}C +g+-F-5<o`:OfEVH2letG3y13 _RRlgw!QP<kO=T GX&^' );
define( 'SECURE_AUTH_SALT', '97&)l,_^UF_5M,5}h7x<(+zsCOs*+l?B{K  V/k72G2^yZ&1fG~*L?nG,+,4s~r%' );
define( 'LOGGED_IN_SALT',   '!aRu!,<T>AGE.) x@<Hl,2h;2|Ge(k3)4?Z`^!%n-GMr>*wX{z?(01iG9EuUM5+0' );
define( 'NONCE_SALT',       '%{+kfpp-BjA Y@y:tf51s;a-$PcnNU6#8h+SKU%1YDz/<Q!U4[0v>/z{b]J!`7_u' );

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
