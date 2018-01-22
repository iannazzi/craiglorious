#!/usr/bin/env bash
f=/var/www/craiglorious.com

cd $f/staging
php artisan down --message="Upgrading Database" --retry=60
git fetch --all
git reset --hard origin/develop

composer install
npm install

npm run production
php artisan up


