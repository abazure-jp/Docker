# Docker
※自分用覚書です
私はOSX上のdockerめっちゃ使うマンです。

データとソースを極力分離して扱いたい。
そこでデータボリュームコンテナを作成して諸々のサービスのうちデータだけをAWS S3にrsyncしたい。


## (´⊙ω⊙\` ≡ ´⊙ω⊙\`)

### mysql
```
docker create -v /var/lib/mysql --name=myapp-data busybox /bin/true
docker run --volumes-from myapp-data --name myapp-mysql -p 13306:3306 -e MYSQL_ROOT_PASSWORD=mysql@pass -d mysql
```
 - データボリューム用のbusyboxは起動していなくても存在していればOK
 - デフォの`my.cnf`は文字コードがlatin1になっていて困るので`-v hogehoge.cnf:/etc/mysql/conf.d`で設定を変えよう。
   - MySQL5.5.3以降であれば`utf8mb4`が安牌のようだがそれ未満では対応していない。２次ソースだが(ここ)[http://pc.thejuraku.com/wordpress-4-2、mysql-5-5-3及びutf8mb4について/2178/]の説明が分かりやすかった。
 - ポートマッピングはホストからDB参照することもあるだろうと用意した。開発環境とかで使うかも

### postgres





いろいろ(´ᕦ∀ᕤ｀)
