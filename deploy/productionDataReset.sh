#!/usr/bin/env bash
f=/var/www/craiglorious.com


read -p "THIS WILL KILL PRODUCTION DATA Are you sure? " -n 1 -r
echo    # (optional) move to a new line
if [[ $REPLY =~ ^[Yy]$ ]]
then
    sed -i 's/APP_ENV=production/APP_ENV=staging/g' $f/live/.env
    cd $f/live
    php artisan zz:dms
    php artisan zz:dst
    sed -i 's/APP_ENV=staging/APP_ENV=production/g' $f/live/.env
fi

