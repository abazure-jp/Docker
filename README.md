# Docker

## data
busyboxで`-v /unpkoa`みたいな感じでデータ用のコンテナつくる。backupはdocker-hubにprivateで。
```
ducker create -ti -v /unpoko --name unpoko busybox
```

`docker inspect`でわかることではあるけれど、ボリュームとコンテナ名は同一にしておこう。
たとえば、mysql用であれば次のようになる。

``
docker create -ti -v /mysql-storage --name=mysql-storage busybox
``


## mysql
当初の目標ではmysqlと言わず諸々のデータ部だけを`-v /data`みたいなコンテナ内のボリュームとして冪等性を与えて管理を楽にしたいとかそういうのだった。これじゃ外部HDD付けただけだ。いやまて。

次にmysqlだとかのサービスのdataの保存先を変えなきゃならない。変えなきゃならない？
デフォルトのパスと、`docker run -v`で作成したdataコンテナ内のボリュームをくっつければいいだけでは？？
```
docker run -v $(pwd)/mysql/my.cnf:/etc/mysql/conf.d --volumes-from mysql-storage --name mysql -p 13306:3306 -e MYSQL_ROOT_PASSWORD=mysql@pass -d mysql
```
[oembed http://qiita.com/baster/items/32a66766cbfd28e63a6b]
