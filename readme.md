#How to get this thing started.....

## Get Started in the Development Environment
###VM
create a VM - homestead seems to be working
conect to vm
cd ~/Homestead && vagrant up && vagrant ssh
create local_a and testing_a databases

git clone https://github.com/iannazzi/craiglorious.git craiglorious
cd craiglorious
composer install
php artisan key:generate
php artisan jwt:secret
npm install
npm run dev  or npm run watch

SET PASSWORD = 'ffffjjjja;sldkfj';
####edit .env
PP_ENV=local
APP_DEBUG=true
APP_LOG_LEVEL=debug

#DB Setup - yes use all of these
DB_PREFIX=local
MAIN_DB_NAME=a
LOCAL_DB_HOST=127.0.0.1
LOCAL_DB_USERNAME=homestead
LOCAL_DB_PASSWORD=secret
TESTING_DB_HOST=127.0.0.1
TESTING_DB_USERNAME=homestead
TESTING_DB_PASSWORD=secret


### now test Database and api

phpunit --testsuite=all

if this fails check 
phpunit --testsuite=environment
phpunit --testsuite=craiglorious
phpunit --testsuite=tenant
phpunit --testsuite=login
phpunit --testsuite=vendor
etc....

if this fails check 
tests/in/CraigloriousDatabaseTest.php
uncomment some items to debug.
check phpunit.xml  - 
<env name="APP_ENV" value="testing"/>
<env name="DB_PREFIX" value="testing"/>


####setting up the web
change resources/assets/js/config/development.config.js
the host needs to be the testing host....
currently homestead.test
npm run dev
php artisan jwt:secret


####Seed data to local_a
php artisan zz:dms
php artisan zz:dst

should be able to check
http://homestead.test
and login with admin secret



#set up the production server
DO LEMP
add node
add redis
re

##Set up staging
### set up code base
ssh craig@craiglorious.com
cd /var/www/craiglorious.com
git clone https://github.com/iannazzi/craiglorious.git $DATE

sudo chgrp -R www-data $DATE

cd $DATE
git checkout develop
cp /var/www/craiglorious.com/env/stag/.env .

composer install

//can't write to the log....

//took forever.... this worked
//sudo chown -R www-data:www-data storage
//sudo chown -R www-data:www-data bootstrap/cache

sudo chown -R craig:www-data storage
sudo chmod -R ug+w storage
sudo chown -R craig:www-data bootstrap/cache
sudo chmod -R ug+w bootstrap/cache

php artisan jwt:secret
failing php artisan jwt:secret -- git checkout develop fixed

### test back end
vendor/bin/phpunit --testsuite=all

### create stage data if needed
php artisan zz:dms
php artisan zz:dst
npm install
npm run production

ln -sfn 2018-01-09r1 /var/www/craiglorious.com/staging

##Updating existing staging
git fetch --all
git reset --hard origin/develop
### front end

#### updates for changes to package.json
rm package-lock.json
rm -rf node_modules/
npm install

#### changes to src folder (js/css)
npm run production

### backend
#### changes to composer.json
composer install

###changes to app
###changes to the database
php artisan migrate
### reset the database
php artisan zz:dms
php artisan zz:dms





#build




ln -s folder /var/www/craiglorious.com/staging/live
ln -sfn 2018-01-09r1 /var/www/craiglorious.com/staging


### Updating production

cp staging $date-p1
cd live
php artisan down
cd ../$date-p1
cp /var/www/craiglorious.com/env/prod/.env .
php artisan migrate
rm ../live
ln -s . /var/www/craiglorious.com/staging/live
php artisan up


scrathpad

GRANT ALL PRIVILEGES ON * . * TO 'admin'@'localhost';
grant all privileges on *.* to myuser@'%' identified by 'mypasswd';
GRANT ALL PRIVILEGES ON * . * TO 'admin'@'localhost';
CREATE USER 'looser'@'localhost' IDENTIFIED BY 'bitcoin';
GRANT ALL ON *.* TO 'looser'@'localhost';

#php update
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
 sudo apt-get install php7.2 php7.2-common
 
sudo apt-get install php7.2-curl php7.2-xml php7.2-zip php7.2-gd php7.2-mysql php7.2-mbstring

sudo apt-get purge php7.0 php7.0-common

fix nginx
sudo service nginx restart


