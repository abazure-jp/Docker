FROM centos:7
RUN yum update -y

# PHP 7.0
RUN yum -y install epel-release
RUN rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN yum install -y --enablerepo=remi,remi-php70 php php-devel php-mbstring php-pdo php-gd

# phalcon
RUN yum install -y git vim gcc make
RUN cd && git clone git://github.com/phalcon/cphalcon.git
RUN cd /root/cphalcon/build/ && ./install

#httpd
RUN systemctl enable httpd.service
ADD . /var/www/html/

EXPOSE 80
CMD ["/sbin/init"]
