# mysql on Docker
自分用覚書です

## data
busyboxで`-v /unpkoa`みたいな感じでデータ用のコンテナつくる。
よくわかんないけど公式mysqlイメージのデフォではデータの保存先が`/var/lib/mysql`らしいのでそこを別コンテナとつなげる。
これによってmysqlコンテナを消しても、データ用のコンテナ内にデータが残る。
backupはdocker-hubにprivateで。
``
docker create -ti -v /var/lib/mysql --name=mysql-data busybox /bin/true
``

## mysql
次にmysqlだとかのサービスのdataの保存先を変えなきゃならない。変えなきゃならない？うせやろ？
デフォルトのパスと、`docker run -v`で作成したdataコンテナ内のボリュームをくっつければいいだけでは？？

[qiitaのこの記事]( http://qiita.com/baster/items/32a66766cbfd28e63a6b )でもそんな感じのことをしてるっぽい。
つまり、公式のmysqlイメージのデータ保存パスは`/var/lib/mysql`なので、そこを`--volumes-from`で外部のコンテナ上のボリュームにつなげている。

```
docker run --volumes-from mysql-data --name mysql -p 13306:3306 -e MYSQL_ROOT_PASSWORD=mysql@pass -d mysql
```
`-p 13306:3306`でポートマッピングしたのはsequalとかlocalから見ることもあるよね？？という希望で。あとintelliJのdockerプラグインでも使う予感したので。

## mysql+busybox
まとめると、結局 [さっきのqiitaの記事]( http://qiita.com/baster/items/32a66766cbfd28e63a6b ) をなぞる形になっている
良記事だったんやな

