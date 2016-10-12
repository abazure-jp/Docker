```
docker create -v /var/lib/mysql --name=redmine-data busybox /bin/true
docker run --volumes-from redmine-data -v /..../redmine/mysql/my.cnf:/etc/my.cnf --name redmine-mysql -p 13306:3306 -e MYSQL_ROOT_PASSWORD=mysql@pass -e MYSQL_DATABASE=redmine -d mysql
docker run -d --name redmine -e VIRTUAL_HOST=my.redmine --link redmine-mysql:mysql redmine
```

あとでこれをdocker-composeにまとめてくれ

