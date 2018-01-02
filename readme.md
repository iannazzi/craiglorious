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
gulp

check phpunit.xml for test
phpunit --testsuite=craiglorious

localhost:82



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

