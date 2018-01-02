#!/usr/bin/env bash

# ie destination 38a395c6fb21b73b85991fa9f527ffa831d2577f9bfaba4855d9ef9e952bff72
#run source ./deploy.sh
name=$RANDOM
        DATE=`date +%Y%m%d%H%M%S`
docker-machine create --driver digitalocean --digitalocean-size 2gb --digitalocean-access-token 36a01604e3a5ee4ce35b177fee8ee6f4ea9aca9711b546ac521518e4ad1076e0 $DATE
eval $(docker-machine env $DATE)
cd ../../laradock_craiglorious/
docker-compose up -d nginx mysql

#looks like this has to go to a docker file...sweet!!!
#docker-compose exec workspace bash
## no not this..... docker-machine ssh $DATE
#git clone https://github.com/iannazzi/craiglorious.git
#cd craiglorious
#composer install
#apt-get update &&
#apt-get install -y nodejs &&
#apt-get install -y npm
#npm install