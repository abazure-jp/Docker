#This is say0213/wordpress
FROM centos:6.7
MAINTAINER Say Sano <say.0213@gmail.com>
RUN yum install -y rpm which tar svn
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
RUN chmod -R 777 /var/lib/mysql/

#apache
RUN echo "/usr/sbin/httpd" >> ~/.bashrc
RUN chkconfig httpd on
ADD asset/httpd.conf /etc/httpd/conf/httpd.conf
ADD asset/php.ini /etc/php.ini

#wordpress
##install wp_cli
RUN curl -L https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar > /usr/local/bin/wp
RUN chmod +x /usr/local/bin/wp

##install php_unit
RUN curl -L https://phar.phpunit.de/phpunit-4.8.26.phar > /usr/local/bin/phpunit
RUN chmod +x /usr/local/bin/phpunit

## wordpress
ADD asset/wordpress /var/www/html/wordpress
ADD asset/wp-config.php /var/www/html/wordpress/wp-config.php
ADD asset/wordpress.sql /root/wordpress.sql
RUN service mysqld start && mysql wordpress < /root/wordpress.sql

#そのた
ADD asset/phpMyAdmin /var/www/html/phpMyAdmin

## wordpress_test
RUN service mysqld start && cd /var/www/html/wordpress/wp-content/plugins && wp scaffold plugin makeTestEnv
RUN service mysqld start && /var/www/html/wordpress/wp-content/plugins/makeTestEnv/bin/install-wp-tests.sh wordpress_test wordpress_test wordpress_test@pass localhost
RUN rm -rf /var/www/html/wordpress/wp-content/plugins/makeTestEnv


## clean up
RUN yum clean all
