#!/usr/bin/env bash
f=/var/www/craiglorious.com

DATE=`date +%Y%m%d%H%M%S`
DATE=`date +%Y%m%d`
DATEP=$DATE'-p1'

rm -rf $f/$DATEP
mkdir $f/$DATEP
cp -r $f/staging/* $f/$DATEP
cd $f/live
pwd
php artisan down
cd /var/www/craiglorious.com/$DATEP
pwd
cp $f/env/prod/.env .
php artisan jwt:secret
php artisan zz:MigrateProduction
cd $f
pwd
rm $f/live
ln -s $DATEP $f/live
cd $f/live
pwd
php artisan up