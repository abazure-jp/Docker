# Mysql on Docker
※自分用覚書です

データとソースを極力分離して扱いたい。
そこでデータボリュームコンテナを作成して諸々のサービスのうちデータだけをAWS S3にrsyncしたい。

## data
```
docker create -v /var/lib/mysql --name=data busybox /bin/true
```
`docker ps -a`しないとでないけどそれで良いらしい。

## Mysql

[qiitaのこの記事]( http://qiita.com/baster/items/32a66766cbfd28e63a6b )でもそんな感じのことをしてるっぽい。
つまり、公式のmysqlイメージのデータ保存パスは`/var/lib/mysql`なので、そこを`--volumes-from`で外部のコンテナ上のボリュームにつなげている。

```
docker run --volumes-from mysql-data --name mysql -p 13306:3306 -e MYSQL_ROOT_PASSWORD=mysql@pass -d mysql
```
上のコマンドには記されていないが、デフォの`my.cnf`は文字コードがlatin1になっていて困るので`-v hogehoge.cnf:/etc/mysql/conf.d`で設定を変えよう。
MySQL5.5.3以降であれば`utf8mb4`が安牌のようだがそれ未満では対応していない。
２次ソースだが(ここ)[http://pc.thejuraku.com/wordpress-4-2、mysql-5-5-3及びutf8mb4について/2178/]の説明が分かりやすかった。


`-p 13306:3306`でポートマッピングしたのはsequalとかlocalから見ることもあるよね？？という希望で。あとintelliJのdockerプラグインでも使う予感したので。


