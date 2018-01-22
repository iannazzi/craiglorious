#!/usr/bin/env bash
#stage quick fix
f=/var/www/craiglorious.com

cd $f/staging
git fetch --all
git reset --hard origin/develop

npm run production



