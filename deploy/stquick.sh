#!/usr/bin/env bash
cd staging
php artisan down --message="Upgrading Database" --retry=60
git fetch --all
git reset --hard origin/develop
php artisan up


