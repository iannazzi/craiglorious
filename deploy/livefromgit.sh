#!/usr/bin/env bash

DATE=`date +%Y%m%d`
DATEP=$DATE'-gl1'

rm -rf $DATEP
git clone https://github.com/iannazzi/craiglorious.git $DATEP
sudo chgrp -R www-data $DATEP
cd $DATEP
git checkout develop
cp /var/www/craiglorious.com/env/prod/.env .
composer install

sudo chown -R craig:www-data storage
sudo chmod -R ug+w storage
sudo chown -R craig:www-data bootstrap/cache
sudo chmod -R ug+w bootstrap/cache

php artisan jwt:secret

npm install
npm run production

cd ../live
pwd
php artisan down
cd ../$DATEP
php artisan zz:MigrateProduction
cd ..
rm live
ln -s $DATEP /var/www/craiglorious.com/live
cd live
pwd
php artisan up