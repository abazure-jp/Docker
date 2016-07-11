# What is this?


TODO: どーにかしてsiteurl,hostをwp cliとかで済ますようにできん？

-> sqlでテーブルのprefixを`wp_`に書き換える

つーか前提がsqlとwp-content有りきら長ったらしいバインドフルパスじゃなくて

こうなんというか手心というか…





This is material of Docker Image [say0213/wordpress](https://hub.docker.com/r/say0213/wordpress/) for wordpress developer.

 - CentOS 6.7
 - httpd 2.2
 - PHP 5.6
 - MySQL 5.6
 - wp_cli
 - phpunit
 - wordpress
 - wordpress_test
 - phpMyAdmin

# How to struct container
```
dokcer run -d -ti -p 80:80 --name='wordpress' say0213/wordpress '/bin/bash'
```

# wordpress

> User: wordpress

> PASS: wordpress@pass

This docker images contain `wp-cli`. when use it type `wp`.

## Eigo muzukasii desu

unzipしたばかりのwordpressとその後インストールしたwordpressのdiffみたらwp-config.phpと.htaccessにだけ反応した。

インストールってのはDBへのinitデータぶっこみとコンフィグファイルの作成だけってことなのかな？

つーことは基本的にwordpressの動的な部分って*wp-config.php*と*wp-content/*と*DB*と*.htaccess*だけってことになる。なるよね？

なのでwp-config.phpとwp-contentとDBと.htaccessだけ-vでバインドすることでよりスマートに扱えるんじゃないでしょうか。

### 本番環境のwordpressをローカルのdocker内で再現したい
-vで上記の動的な部分だけバインドしよう。
たとえば、本番環境のwordpressから
*wp-config.php*と*wp-content/*と*sqldump*と*.htaccess*を手元に持ってくる。これらをhoge/に配置するとする。
その後次のコマンド。
なおコマンドでは-v以降のローカルディレクトリがhoge/wp-contentとなっているが、実際はフルパスじゃないと動こかないので気をつけて。
```
dokcer run -d -ti -p 80:80 --name='hoge' -v hoge/wp-content:/var/www/html/wordpress/wp-content -v  hoge/wp-config.php//var/www/html/wordpress/wp-config.php -v aiuoe/.htaccess:/var/www/html/wordpress/.htaccess say0213/wordpress '/bin/bash'
```

つぎに`dockerhost/phpMyAdmin`にアクセスして.sqldumpファイルをDB名:wordpressに突っ込む。
あとはwp-config.phpを微妙に調整したりDB:wordpresのoptionsからsiteurlあたりをdocker-machine ipの値に書き換えましょう。


## ちなみに
-vで動的な部分をバインドしない場合、つまり、
```
dokcer run -d -ti -p 80:80 --name='wordpress' say0213/wordpress '/bin/bash'
```
でコンテナを立てると、解答してインストールした直後の、初期設定wordpressにアクセス出来るようになってます。プラグイン開発したい時とかにいいかもしれない。

その場合、

>WP User: wordpress

>WP Pass: wordpress@pass

dbも同じIDとPassだけどrootユーザーにパスワードを設定していないので、人間が見る分にはrootでもおk

wp_cliに準拠したテスト環境もデフォで入っているので都度[plugin]/bin/test_install.shする必要はないです。該当プラグイン下でtestsがあればphpunitできます。

なおphpunit用の環境情報は

DB: wordpress_test

USER: wordpress_test

PASS: wordpress_test@pass

