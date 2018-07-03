<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

if ( isset($_GET['debug']) && $_GET['debug'] == 'debug') define('WP_DEBUG', true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'devcotzydu_db1');

/** MySQL database username */
define('DB_USER', 'devcotzydu_1');

/** MySQL database password */
define('DB_PASSWORD', 'SD8iFi88');

/** MySQL hostname */
define('DB_HOST', 'sql1.cpt4.host-h.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'K3XF2Fdh~i#2|s|k`a+06K7qodJ_Dc11g.Zi;U4);^EM8@jsl{=qL|[T}>HpkLIn');
define('SECURE_AUTH_KEY',  '-4Yqd6r}<|JL3d(1:w-H,.v0a`h02HA4,Q?g-f -K/G^_pOU<(},*wxQJ_4-PUzq');
define('LOGGED_IN_KEY',    'KmI(|52KN7$coFfc+fFxVU*-p1kge!{5B`xW[|25I5MCV-[LwsVF=Y=x[t7<1RlD');
define('NONCE_KEY',        'l*%|#[+^06;;G%B*#!=Kz<)o;=$&6XWZan M~zo;uiYs43^GmD4/zxDw5>-`conc');
define('AUTH_SALT',        '|,B?.f9V-!bTVHYP>Mz[-.R|@:XviPAMA(]^z5[@|D50-|IS~[Of]7|B;yK No+r');
define('SECURE_AUTH_SALT', '~y1}2ldGd-`=1rKGqX>kf}9C(WxaFk 8`;LN*+%AK2t#{jgh(daqf!E=I!rT$qm*');
define('LOGGED_IN_SALT',   '98(|Il-G|-_uVf6fAI!k@gPfo6uEu-D~|&7$Ieib7+-y0B|TzIrWoY+@x$=lpC|%');
define('NONCE_SALT',       '~RS/-,`OP=a6&p?S/DMU}g5liH~rH<[D$=2?be{y$aJdw|HA$Lg+Zi|y|MqVn1|+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
