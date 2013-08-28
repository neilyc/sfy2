
# SFY2 ready to code

## Setup

### Clone du CMS

```
git clone https://github.com/thomaroger/sfy2.git
```

### setup

```
chmod 755 setup.sh
./setup.sh
```

## Run tests

```
./run_test.sh
phpunit -c app/
```

## Vhost

```
<Virtualhost *:80>
  ServerName devwww.sfy2.fr
  DocumentRoot "/var/local/webroot/sfy2/web"
  DirectoryIndex app_dev.php
  <Directory "/var/local/webroot/sfy2/web">
    AllowOverride All
    Allow from All
  </Directory>
</VirtualHost>
```
