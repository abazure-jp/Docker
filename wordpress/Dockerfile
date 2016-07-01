#This is say0213/wp
FROM centos:6.7
MAINTAINER Say Sano <say.0213@gmail.com>
RUN yum install -y rpm
RUN rpm -Uvh http://ftp.iij.ad.jp/pub/linux/fedora/epel/6/x86_64/epel-release-6-8.noarch.rpm
RUN rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
RUN yum install -y --enablerepo=remi --enablerepo=remi-php56 php
RUN yum install -y --enablerepo=remi --enablerepo=remi-php56 php-pecl-imagick php-intl php-mbstring php-xml php-api php-pdo php-mysql php-common

RUN yum install -y --enablerepo=remi mysql-server
RUN yum install -y httpd glibc-common gcc make

# mysql
ADD asset/my.cnf /etc/my.cnf
RUN echo "/sbin/service mysqld start" >> ~/.bashrc
RUN touch /var/lib/mysql/mysql.sock && chown -R mysql:mysql /var/lib/mysql

RUN echo "NETWORKING=yes" >/etc/sysconfig/network
ADD asset/init.sql /root/init.sql
RUN service mysqld start && mysql < /root/init.sql

#apache
RUN echo "/usr/sbin/httpd" >> ~/.bashrc
RUN chkconfig httpd on

ADD asset/httpd.conf /etc/httpd/conf/httpd.conf
ADD asset/php.ini /etc/php.ini
ADD asset/phpMyAdmin /var/www/html/phpMyAdmin
ADD asset/wordpress /var/www/html/wordpress

RUN chmod -R 777 /var/lib/mysql/

RUN chmod -R 775 /var/www/html
RUN chown -R apache:apache /var/www/html

#Todo
#nslookupの変更

