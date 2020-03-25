# NGINX configuration

* In /etc/nginx/sites-available addef configuration file *introphp*

```
server {
  listen 80 ;
  listen [::]:80 ;
  root /var/www/introphp;
  index index.php;
  server_name introphp;
  location / {
    try_files $uri $uri/ =404;
  }

  location ~ \.php$ {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/var/run/php/php7.3-fpm.sock;
  }
}

```

* added a symbolic link to /etc/nginx/sites-enabled
* added a symbolic link to /var/www: introphp -> /home/pjmd/PhpWorkspace/Intro/
* added to /etc/hosts an alias *introphp* to the loopback 

*Note*:  
nginx logfile is /var/log/nginx/error.log
