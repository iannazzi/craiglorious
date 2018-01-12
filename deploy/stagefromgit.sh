#!/usr/bin/env bash

DATE=`date +%Y%m%d`
DATEP=$DATE'-gs1'

rm -rf $DATEP
git clone https://github.com/iannazzi/craiglorious.git $DATEP
sudo chgrp -R www-data $DATEP
cd $DATEP
git checkout develop
cp /var/www/craiglorious.com/env/stag/.env .
composer install
php artisan jwt:secret

npm install
npm run production

sudo chown -R craig:www-data storage
sudo chmod -R ug+w storage
sudo chown -R craig:www-data bootstrap/cache
sudo chmod -R ug+w bootstrap/cache

cd /var/www/craiglorious.com/staging
pwd
php artisan down
cd /var/www/craiglorious.com/$DATEP
pwd
php artisan zz:dms
php artisan zz:dst

cd /var/www/craiglorious.com
pwd
rm staging
ln -s $DATEP /var/www/craiglorious.com/staging
cd staging
pwd
php artisan up