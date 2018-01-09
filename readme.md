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

####edit .env
APP_ENV=local
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





##Set up staging

ssh craig@craiglorious.com
cd /var/www/craiglorious.com
git clone https://github.com/iannazzi/craiglorious.git $DATE
cd $DATE
git checkout develop
cp /var/www/craiglorious.com/env/stag/.env .

composer install

//can't write to the log....
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache



follow directions in local


failing php artisan jwt:secret -- git checkout develop fixed
failing npm install with killed changed to 3 gb ram droplet fixed


#build
failing npm run production and npm run dev

failing Cannot find module 'node-sass'
rm package-lock.json
rm -rf node_modules
npm install

-- might not still have a decent build utiltiy......


failing php artisan zz:dms   -- .env was incorrecto

php artisan zz:dms
php artisan zz:dms



copy the production database?
create fake data?
php artisan migrate


ln -s folder /var/www/craiglorious.com/staging/live
ln -sfn 2018-01-09r1 /var/www/craiglorious.com/staging


## Set up production
would be nice to 

cp /var/www/craiglorious.com/env/prod/.env .

git push master production

otherwise

shut down site
cp /var/www/staging/release_folder_name .
cp /var/www/production/.env ./
symlink to live

php artisan migrate
turn on site

