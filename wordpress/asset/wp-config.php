<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wordpress');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'wordpress');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'wordpress@pass');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+a>:p-+K],P>/,M&_,.w-2P&$EB=hThC[1wv]%[r23+2X1 )908@.aG%/-lm3C}c');
define('SECURE_AUTH_KEY',  '%0xVjDcBsU.pY80JTz$kycl#%;SBPh|EB<a9G;=^U/ztOdX$4<.}0px_X>yp9+PO');
define('LOGGED_IN_KEY',    '-V|Og8mrSp4<iSOja},{WY34.}& ]z@2yr&u=w[Y@@vPO3BHA>tn/7oXl-4OVXjj');
define('NONCE_KEY',        '9Zm:LON:r)EpoObcf;}@{27V=Lh&&Eu/oVw?!4_8O1G5JP)NYWG>NL?)E)c})QTa');
define('AUTH_SALT',        ')3A>6oOuIw&[Rr#yLCBX,}(bfHHZ,$[z*P%ZTS$ZI,g0>&m?;e( abGwoa<pYHUZ');
define('SECURE_AUTH_SALT', 'uQpw0^JN,}[ZPl?WKN)S=N[%B&_u_,,x;>QdB*f)N:t2z/7m3RI=/{6]_H&3+Abd');
define('LOGGED_IN_SALT',   'v{9w#NW&R: h=e-!avMy`b!ULblN;?k[W&HOdX>`Cjeo#?uJ>,>xy=,H2bSdHaA1');
define('NONCE_SALT',       '`;Hhp_@gn14[=HPp3P{mJ  >M]Z9[<v,zld%cd|t!A>{lPm%sn~x)~+57$CWf)C-');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
