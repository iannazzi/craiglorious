#!/usr/bin/env bash
f=/var/www/craiglorious.com
#git fetch --all &&\
#git reset --hard origin/develop &&\
ssh craig@craiglorious.com "cd $f/staging &&\
php artisan down &&\
git pull

composer install &&\
npm install &&\

npm run production &&\
php artisan up"


