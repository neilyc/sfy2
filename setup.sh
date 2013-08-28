#!/bin/sh
set -xe

# Local parameters
if [ ! -f app/config/parameters.yml ];
then
    cp app/config/parameters.yml.dist app/config/parameters.yml
fi

if [ ! -f app/phpunit.xml ];
then
    cp app/phpunit.xml.dist app/phpunit.xml
fi

if [ ! -f composer.phar ];
then
wget http://getcomposer.org/composer.phar
fi


php composer.phar install
#php composer.phar install --prefer-source

# Rebuild propel default + database
#php app/console propel:database:drop --force --connection=default
#php app/console propel:database:create --connection=default

#php app/console propel:build --verbose
#php app/console propel:sql:insert --force --connection=default

php composer.phar dump-autoload -o


# removes cache
sudo rm -rf */cache/*

# cache warmup (for routing)
php app/console cache:warmup

# Symlink assets
php app/console assets:install web --symlink

# Rebuild commons css/js through assetic
php app/console assetic:dump --force
