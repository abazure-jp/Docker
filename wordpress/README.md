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
