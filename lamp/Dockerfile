FROM centos:6.8

RUN rpm -Uvh http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm
RUN rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
RUN yum install -y --enablerepo=remi,remi-php56 php php-devel php-mbstring php-mcrypt php-mysql
RUN yum install -y --enablerepo=remi mysql mysql-server
RUN echo "/usr/sbin/httpd" >> ~/.bashrc
RUN echo "/usr/sbin/mysqld" >> ~/.bashrc
