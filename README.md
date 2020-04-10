# LNMP Linux Nginx Mysql Php - LAMP Linux Apache Mysql Php

I **stopped using PHP7.3 now I use PHP7.4 everywhere (see debug section below)**

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

/var/www/html/phpinfo.php
http://localhost:88/phpinfo.php  

#### Adding the introphp web site to apache2
I already had installed introphp fo nginx and created a folder **/var/www/introphp**.
So I:  

```
$ sudo cp 000-default.conf introphp.conf
$ sudo vi introphp.conf
        ServerName introphp
        DocumentRoot /var/www/introphp
$ a2ensite introphp.conf
$ sudo systemctl reload apache2
```
Job's done.

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

### Debugging in web browser - console
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

To debug the php code without triggering it via the browser, just select "Launch currently open script" from the config (see top left corner of php)  

#### Note
I decide to run everything in Apache2 to make my life easier PHP, Phpmyadimn, Xdebug, introphp

#### Apache

Because I had Xdebug installed for Apache2 I decided to add the **introphp** website to Apache.  
Now to debug the website I just need to select from lunch.json the **"Listen For Xdebug"** configuration and run the site: **http://introphp:88/src/mooc/db_hydratation/webapp.php**. VScode will to to any breakpoint set in webapp.php.

Aslo see https://www.geeksforgeeks.org/how-to-debug-php-scripts/

### Fiddling with php

Having php7.3 and php7.4 caused trouble I couldn't make the VSCode debugger run (I believe VSCode run php7.4 but I intalled xdebug for php7.3).  
So I 
```
sudo pecl uninstall xdebug
sudo pecl install xdebug
```

To run /var/www/introphp in php7.4 I changed in /etc/nginx/sites-available the entry:** location ~ \.php$**  
```
from
  location ~ \.php$ {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/var/run/php/php7.3-fpm.sock;
  }
to
  location ~ \.php$ {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
  }
```

## Refs:
https://www.ostechnix.com/install-apache-mysql-php-lamp-stack-on-ubuntu-18-04-lts/

Composer https://getcomposer.org/doc/00-intro.md
debugger http://phpdebugbar.com/


## My Tutorial

### TOC

* [Introduction - Class](https://github.com/PhP-Pj/Intro/blob/master/php.md)
* [DB & Hydratation](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/db_hydratation/README.md)
* [Inheritance](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/inheritance/README.md)
* [Magic Methods](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/MagicMehods/README.md)
* [The objects](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/objects/README.md)
* [Interfaces](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/interfaces/README.md)
* [Exceptions](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/Exceptions/README.md)
* [Traits](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/Traits/README.md)
* [Introspection](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/Introspection/README.md)
* [Design Pattern](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/design Patterns/README.md)
* [Generators](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/Generators/README.md)
* [Closures](https://github.com/PhP-Pj/Intro/blob/master/src/mooc/closures/README.md)
* [Front End]()
* [Backend]()
* []()
* []()

