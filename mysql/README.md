# Mysql on Docker
※自分用覚書です
dockerが便利なのでかなりお世話になっている。けれどデータだけが違う同一のウェブサービスがある時に、同一のウェブサービスコンテナに別の名前を付けて運用するのが計算機にコストかかるし都度面倒な-vとか書いたり覚えたりすんのだるい。あとmysqlのバージョンかえます〜〜〜ってなったときもっと手軽にマイグレーションしたい。

こういった問題をdocker上のコンテナだけで解決してくれる機能があるらしい。

## data
mysqlのデータを保存する為のコンテナを作る。
どうやらmysqlのデータは`/var/lib/mysql/`に保存されるらしいので、同じパスのボリュームを作成した`busybox`を建てる。
```
docker create -v /var/lib/mysql --name=mysql-data busybox /bin/true
```
`docker ps -a`しないとでないけどそれで良いらしい。

ここでいうボリュームのみが`--volumes-from`で利用可能になるらしい。
あと`docker commit`とかすると消えるらしい。ではどうやって永続性を得るというのか。





## Mysql

[qiitaのこの記事]( http://qiita.com/baster/items/32a66766cbfd28e63a6b )でもそんな感じのことをしてるっぽい。
つまり、公式のmysqlイメージのデータ保存パスは`/var/lib/mysql`なので、そこを`--volumes-from`で外部のコンテナ上のボリュームにつなげている。

```
docker run --volumes-from mysql-data --name mysql -p 13306:3306 -e MYSQL_ROOT_PASSWORD=mysql@pass -d mysql
```
`-p 13306:3306`でポートマッピングしたのはsequalとかlocalから見ることもあるよね？？という希望で。あとintelliJのdockerプラグインでも使う予感したので。





