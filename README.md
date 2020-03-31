# LNMP Linux Nginx Mysql Php - LAMP Linux Apache Mysql Php

## Running PhP files in the Web server

PHP files first need be processed in a web server before sending their output to the web browser.  

* Installed a php engine for **NGINX** to execute **PHP**  
* **NGINX** listens to port **80**
  * **introphp** is the "domain name" on nginx for the php examples.
  * http://introphp/static.php
  * **nginx** runs **php 7.3**
* **MYSQL** admin UI **phmypadmin** runs in **APACHE** which listens to port **88**  
  * **apache** runs **php 7.4**
  * http://localhost:88/info.php to check php was properly installed
  * http://localhost:88/phpmyadmin mysql admin UI


### Logging
sudo tail /var/log/nginx/error.log -n 200

### PhP installation for Ngnix 
See https://tecadmin.net/install-nginx-php-fpm-ubuntu-18-04/ to find out how to configure PHP for nginx.

**Note:**
sudo add-apt-repository ppa:ondrej/php would hang so I added the ppa entries manually to **/etc/apt/sources.list**.  
Found the entries in https://launchpad.net/~ondrej/+archive/ubuntu/php in section Technical details about this PPA for my version of ubuntu.

### Apache

http://localhost:88/phpinfo.php  

## MYSQL PHP interface

The two extesion/Api recommended are:
* PHP Data Objects, or PDO
* ext/mysqli

Package phpN.M-mysql contains the apis.  
```
sudo apt-cache show php7.n-mysql
Provides: php-mysqli, php-mysqlnd, php-pdo-mysql, php7.4-mysqli, php7.4-mysqlnd, php7.4-pdo-mysql
```
The APIs for my php7.3. were not install (whereas they were for 7.4).  
To insatll them:
```
sudo apt-get install php7.3-mysql
```

See https://www.php.net/manual/en/mysqlinfo.api.choosing.php  for a comparison


## dependencies manager

**Composer**
See https://getcomposer.org/doc/00-intro.md  

In the project folder

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

## Debugger

### Debugging in web browser
debbuging: https://www.php.net/manual/en/debugger.php  

**PHP Debug Bar**
See http://phpdebugbar.com/

```
php7.3 composer.phar install
```

### Debugging in VS Code

* installed PHP Debug extension by Felix Becker which depends on Xdebug (See Felix's description)
* installed sudo apt-get install **php7.3-dev** to get phpize and php-config
* sudo pecl install xdebug
```
$> sudo pecl install xdebug
Build process completed successfully
Installing '/usr/lib/php/20180731/xdebug.so'
install ok: channel://pecl.php.net/xdebug-2.9.4
configuration option "php_ini" is not set to php.ini location
You should add "zend_extension=/usr/lib/php/20180731/xdebug.so" to php.ini
```
* Added /usr/lib/php/20180731/xdebug.so to /etc/php/7.3/fpm/php.ini 
* Added [XDebug] entry.
* sudo service php7.3-fpm restart
* check install from browser: phpinfor or CLI php7.3 -m. This lists all loaded modules - Xdebug.

### Fiddling with php
```
$ which php
/usr/bin/php
$ ll /usr/bin/ph*
lrwxrwxrwx 1 root root      22 mars  25 17:42 /usr/bin/phar -> /etc/alternatives/phar*
lrwxrwxrwx 1 root root      12 mars  20 14:51 /usr/bin/phar7.3 -> phar.phar7.3*
lrwxrwxrwx 1 root root      12 mars  20 14:47 /usr/bin/phar7.4 -> phar.phar7.4*
lrwxrwxrwx 1 root root      27 mars  25 17:42 /usr/bin/phar.phar -> /etc/alternatives/phar.phar*
-rwxr-xr-x 1 root root   14814 mars  20 14:51 /usr/bin/phar.phar7.3*
-rwxr-xr-x 1 root root   14885 mars  20 14:47 /usr/bin/phar.phar7.4*
lrwxrwxrwx 1 root root      21 mars  25 17:42 /usr/bin/php -> /etc/alternatives/php*
-rwxr-xr-x 1 root root 4683512 mars  20 14:51 /usr/bin/php7.3*
-rwxr-xr-x 1 root root 4638488 mars  20 14:47 /usr/bin/php7.4*
l

$ ll /etc/alternatives/ph*
lrwxrwxrwx 1 root root 16 mars  27 16:30 /etc/alternatives/phar -> /usr/bin/phar7.4*
lrwxrwxrwx 1 root root 32 mars  27 16:30 /etc/alternatives/phar.1.gz -> /usr/share/man/man1/phar7.4.1.gz
lrwxrwxrwx 1 root root 21 mars  27 16:30 /etc/alternatives/phar.phar -> /usr/bin/phar.phar7.4*
lrwxrwxrwx 1 root root 37 mars  27 16:30 /etc/alternatives/phar.phar.1.gz -> /usr/share/man/man1/phar.phar7.4.1.gz
lrwxrwxrwx 1 root root 15 mars  27 16:30 /etc/alternatives/php -> /usr/bin/php7.4*
lrwxrwxrwx 1 root root 31 mars  27 16:30 /etc/alternatives/php.1.gz -> /usr/share/man/man1/php7.4.1.gz
lrwxrwxrwx 1 root root 22 mars  31 12:04 /etc/alternatives/php-config -> /usr/bin/php-config7.4*
lrwxrwxrwx 1 root root 38 mars  31 12:04 /etc/alternatives/php-config.1.gz -> /usr/share/man/man1/php-config7.4.1.gz
lrwxrwxrwx 1 root root 24 mars  31 12:12 /etc/alternatives/php-fpm.sock -> /run/php/php7.4-fpm.sock=
lrwxrwxrwx 1 root root 18 mars  31 12:04 /etc/alternatives/phpize -> /usr/bin/phpize7.4*
lrwxrwxrwx 1 root root 34 mars  31 12:04 /etc/alternatives/phpize.1.gz -> /usr/share/man/man1/phpize7.4.1.gz

$  cd /etc/alternatives/
$ sudo rm php
$ sudo ln -s /usr/bin/php7.3 php


```


## Refs:
https://www.ostechnix.com/install-apache-mysql-php-lamp-stack-on-ubuntu-18-04-lts/

Composer https://getcomposer.org/doc/00-intro.md
debugger http://phpdebugbar.com/

