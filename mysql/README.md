# mysql on Docker
自分用覚書です

## data
busyboxで`-v /unpkoa`みたいな感じでデータ用のコンテナつくる。backupはdocker-hubにprivateで。

``
docker create -ti -v /var/lib/mysql --name=mysql-data busybox /bin/true
``

## mysql
当初の目標ではmysqlと言わず諸々のデータ部だけを`-v /data`みたいなコンテナ内のボリュームとして冪等性を与えて管理を楽にしたいとかそういうのだった。これじゃ外部HDD付けただけだ。いやまて。

次にmysqlだとかのサービスのdataの保存先を変えなきゃならない。変えなきゃならない？
デフォルトのパスと、`docker run -v`で作成したdataコンテナ内のボリュームをくっつければいいだけでは？？

[qiitaのこの記事]( http://qiita.com/baster/items/32a66766cbfd28e63a6b )でもそんな感じのことをしてるっぽい。
つまり、公式のmysqlイメージのデータ保存パスは`/var/lib/mysql`なので、そこを`--volumes-from`で外部のコンテナ上のボリュームにつなげている。


```
docker run -v $(pwd)/mysql/my.cnf:/etc/mysql/conf.d --volumes-from mysql-storage --name mysql -p 13306:3306 -e MYSQL_ROOT_PASSWORD=mysql@pass -d mysql
```

## mysql+busybox
まとめると、結局 [qiitaのこの記事]( http://qiita.com/baster/items/32a66766cbfd28e63a6b ) をなぞる形になっているのだが、

