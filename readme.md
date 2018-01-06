#How to get this thing started.....

## Dev
git clone https://github.com/iannazzi/craiglorious.git craiglorious
cd craiglorious

laradock or docker
cd laradock
./up.sh

create .env
from workspace ./workspace.sh
composer install

npm install
Gulp:
npm run dev  or npm run watch

#TESTING.....
create a database testing_databasename (databasename matches .env MAIN_DB_NAME)
modify .env with host user pass 
TESTING_DB_HOST=127.0.0.1
TESTING_DB_USERNAME=homestead
TESTING_DB_PASSWORD=secret

start with 
phpunit --testsuite=craiglorious
if this fails check 
tests/in/CraigloriousDatabaseTest.php
uncomment some items to debug.
check phpunit.xml  - 
<env name="APP_ENV" value="testing"/>
<env name="DB_PREFIX" value="testing"/>

#checking the web
change resources/assets/js/config/development.config.js
the host needs to be the testing host....

npm run dev
##configure the main Main dev database
php artisan zz:dms
php artisan zz:dst

should be able to check
http://homestead.test

##Set up staging
would be nice to use a git hook

git push develop staging

ssh craig@craiglorious.com
git clone https://github.com/iannazzi/craiglorious.git 2017-12-30r1
cd $DATE
copy /var/www/staging/.env .
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
composer install

copy the production database?
create fake data?
php artisan migrate

phpunit test

npm install
gulp
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

