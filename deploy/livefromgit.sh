#!/usr/bin/env bash
f=/var/www/craiglorious.com
DATE=`date +%Y%m%d`
DATEP=$DATE'-gl1'

cd $f
rm -rf $DATEP
git clone https://github.com/iannazzi/craiglorious.git $DATEP
sudo chgrp -R www-data $DATEP
cd $DATEP
git checkout develop
cp $f/env/prod/.env .
composer install

sudo chown -R craig:www-data storage
sudo chmod -R ug+w storage
sudo chown -R craig:www-data bootstrap/cache
sudo chmod -R ug+w bootstrap/cache

php artisan jwt:secret

npm install
npm run production

cd /var/www/craiglorious.com/live
pwd
#php artisan down
cd $f/$DATEP
php artisan zz:MigrateProduction
cd $f
rm live
ln -s $DATEP $f/live
cd $f/live
pwd
#php artisan up