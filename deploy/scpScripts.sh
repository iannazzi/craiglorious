#!/usr/bin/env bash

#copy the script files over to the production server
rsync -avzh -e ssh *.sh craig@craiglorious.com:/var/www/craiglorious.com/scripts/


