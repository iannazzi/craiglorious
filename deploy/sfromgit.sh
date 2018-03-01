#!/usr/bin/env bash

./scpScripts.sh

f=/var/www/craiglorious.com

DATE=`date +%Y%m%d`
DATEP=$DATE'-StageFromGit'
GIT='pusher'

#sudo systemctl restart nginx
#sudo service nginx restart
#sudo nginx -t
#sudo service php7.2-fpm restart
#sudo reboot

ssh -t craig@craiglorious.com "cd $f &&\
rm -rf $DATEP &&\
git clone https://github.com/iannazzi/craiglorious.git $DATEP &&\
sudo chgrp -R www-data $DATEP &&\
cd $f/$DATEP &&\
git checkout $GIT &&\
cp $f/env/stag/.env . &&\
composer install &&\
php artisan jwt:secret &&\

npm install &&\
npm run production &&\

sudo chown -R craig:www-data storage &&\
sudo chmod -R ug+w storage &&\
sudo chown -R craig:www-data bootstrap/cache &&\
sudo chmod -R ug+w bootstrap/cache &&\

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
pwd &&\
sudo service php7.2-fpm reload"
