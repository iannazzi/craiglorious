#!/usr/bin/env bash
#hmm this one failed once so far, looks like it ran old code
f=/var/www/craiglorious.com

cd $f/staging
php artisan down --message="Upgrading Database" --retry=60
git fetch --all
git reset --hard origin/develop

composer install
phpunit --testsuite=all
php artisan zz:dms

#rm package-lock.json
rm -rf node_modules/
npm install
npm run production

php artisan up


