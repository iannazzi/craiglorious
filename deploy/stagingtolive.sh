#!/usr/bin/env bash

DATE=`date +%Y%m%d%H%M%S`
DATE=`date +%Y%m%d`
DATEP=$DATE'-p1'

rm -rf $DATEP
mkdir $DATEP
cp -r ./staging/* ./$DATEP
cd live
pwd
php artisan down
cd /var/www/craiglorious.com/$DATEP
pwd
cp /var/www/craiglorious.com/env/prod/.env .
php artisan jwt:secret
php artisan zz:MigrateProduction
cd ..
pwd
rm live
ln -s $DATEP /var/www/craiglorious.com/live
cd live
pwd
php artisan up