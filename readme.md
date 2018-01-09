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
cp /var/www/craiglorious.com/env/stag/.env .
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
composer install


follow directions in local


failing php artisan jwt:secret -- git checkout develop fixed
failing npm install with killed changed to 3 gb ram droplet fixed
failing npm run production and npm run dev

-- might not still have a decent build utiltiy......





copy the production database?
create fake data?
php artisan migrate


ln -s folder /var/www/craiglorious.com/staging/live


## Set up production
would be nice to 

git push master production

otherwise

shut down site
cd /var/www/craiglorious.com/production
cp /var/www/staging/release_folder_name .
cp /var/www/production/.env ./
symlink to live

php artisan migrate
turn on site

