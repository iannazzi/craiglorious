#!/usr/bin/env bash
#stage quick fix
cd staging
git fetch --all
git reset --hard origin/develop

npm run production



