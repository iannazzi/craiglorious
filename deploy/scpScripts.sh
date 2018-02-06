#!/usr/bin/env bash

#copy the script files over to the production server
rsync -avzh -e ssh *.sh craig@craiglorious.com:/var/www/craiglorious.com/scripts/
rsync -avzh -e ssh ../DataGitIgnore/seeds/EmbrasseMoi/* craig@craiglorious.com:/var/www/craiglorious.com/data/EmbrasseMoi
rsync -avzh -e ssh ../DataGitIgnore/server/production/.env craig@craiglorious.com:/var/www/craiglorious.com/env/prod/.env
rsync -avzh -e ssh ../DataGitIgnore/server/staging/.env craig@craiglorious.com:/var/www/craiglorious.com/env/stag/.env



