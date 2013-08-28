#!/bin/sh
set -xe

# Local parameters
if [ ! -f app/config/parameters.yml ];
then
    cp app/config/parameters.yml-dist app/config/parameters.yml
fi

if [ ! -f app/phpunit.xml ];
then
    cp app/phpunit.xml.dist app/phpunit.xml
fi

php composer.phar install
#php composer.phar install --prefer-source
bundle install --no-deployment --binstubs --path vendor/bundle

# Rebuild propel default
php app/console propel:database:drop --force --connection=default
php app/console propel:database:create --connection=default

# Rebuild propel default & ol oracle
php app/console propel:build --verbose

php composer.phar install --prefer-source
php composer.phar dump-autoload -o

php app/console propel:sql:insert --force --connection=default

# removes cache
sudo rm -rf */cache/*

# cache warmup (for routing)
php app/console cache:warmup

# Symlink assets
php app/console assets:install web --symlink

# Dump backend js routing
php app/console fos:js-routing:dump

# Rebuild commons css/js through assetic
php app/console assetic:dump --force
