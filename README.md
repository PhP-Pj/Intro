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

## Refs:
https://www.ostechnix.com/install-apache-mysql-php-lamp-stack-on-ubuntu-18-04-lts/

