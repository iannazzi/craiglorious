#!/usr/bin/env bash

./scpScripts.sh

f=/var/www/craiglorious.com

DATE=`date +%Y%m%d`
DATEP=$DATE'-StageFromGit'
GIT='schedule'


ssh -t craig@craiglorious.com "cd $f &&\
rm -rf $DATEP &&\
git clone https://github.com/iannazzi/craiglorious.git $DATEP &&\
chgrp -R www-data $DATEP &&\
cd $f/$DATEP &&\
git checkout $GIT &&\
cp $f/env/stag/.env . &&\
composer install &&\
php artisan jwt:secret &&\

npm install &&\
npm run production &&\

chown -R craig:www-data storage &&\
chmod -R ug+w storage &&\
chown -R craig:www-data bootstrap/cache &&\
chmod -R ug+w bootstrap/cache &&\

cd $f/staging &&\
pwd &&\
cd $f/$DATEP &&\
pwd &&\
php artisan zz:dms &&\

cd $f &&\
pwd &&\
rm $f/staging &&\
ln -s $DATEP $f/staging &&\
cd $f/staging &&\
pwd"
