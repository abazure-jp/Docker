# Docker
Dockerfiles and the assets

```
docker build -t say0213/wordpress .
```
or
```
docker pull say0213/wordpress
```
After that,
```
dokcer run -ti -p 80:80 --name='my wordpress' -v [ My wp-content ]:/var/www/html/wordpress/wp-content  say0213/wordpress '/bin/bash'
```
Next, open 'dockerhost/phpMyAdmin/' in browsar, and login.

> User: root

> PASS: (empty)

The name of database using wordpress is docker.
import your wordpress .sqldump in docker.


This docker images contain wp-cli. when use it type `wp`.

# memo

unzipしたばかりのwordpressとその後インストールしたwordpressのdiffみたらwp-config.phpと.htaccessにだけ反応した。

インストールってのはDBへのinitデータぶっこみとコンフィグファイルの作成だけってことなのかな？

つーことは基本的にwordpressの動はwp-config.phpとwp-content/とDBと.htaccessだけってことになる。なるよね？

使い方はこう。

ローカルホスト上ではwp-contentとwp-config.phpと.sqldumpを用意しておく。

コンテナは-vでwp-contentとwp-config.phpだけ共有しておく。

その後コンテナ内にあるphpMyAdminから（直接mysqlやってもいいけど）で.sqldumpファイルを突っ込む。

最後にブラウザからパーマリンク設定をdocker-machine ipの値に変更する。

-vで動的な部分をバインドしない場合、初期設定のwordpressにアクセス出来るようになっている。プラグイン開発したい時とかにいいかもしれない。
その場合、

>User: wordpress

>Pass: wordpress@pass

dbも同じだけどrootユーザーにパスワードを設定していないので、ユーザーが見る分にはrootでもおk

wp_cliに準拠したテスト環境もデフォで入っているので都度[plugin]/bin/test_install.shする必要はないです。該当プラグイン下でtestsがあればphpunitできます。

なおphpunit用の環境情報は

DB: wordpress_test
USER: wordpress_test
PASS: wordpress_test@pass





