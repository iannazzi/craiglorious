#!/usr/bin/env bash
f=/var/www/craiglorious.com
DATE=`date +%Y%m%d`
DATEP=$DATE'-gl1'

./scpScripts.sh


ssh -t craig@craiglorious.com "cd $f &&\
rm -rf $DATEP &&\
git clone https://github.com/iannazzi/craiglorious.git $DATEP &&\
chgrp -R www-data $DATEP &&\
cd $DATEP &&\
git checkout master &&\
cp $f/env/prod/.env . &&\
composer install &&\

chown -R craig:www-data storage &&\
chmod -R ug+w storage &&\
chown -R craig:www-data bootstrap/cache &&\
chmod -R ug+w bootstrap/cache &&\

php artisan jwt:secret &&\

npm install &&\
npm run production &&\

cd /var/www/craiglorious.com/live &&\
pwd &&\
cd $f &&\
rm live &&\
ln -s $DATEP $f/live &&\
cd $f/live &&\
pwd"