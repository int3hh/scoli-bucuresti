#!/bin/bash

RED='\033[0;31m'
NC='\033[0m'
DOT='\033[0;33m ===> \033[0m'

printf " ${DOT} Deploying WEBSITE to ${RED} scolibune.ro ${NC} \n"
ssh root@95.179.185.104 /bin/bash <<EOF
	cd /var/www/scoli-bucuresti/
	git stash
	GIT_SSH_COMMAND='ssh -i /root/.ssh/id_scolibune' git pull
	composer dump-autoload
	php artisan migrate --force
	cd ..
	chmod -R 755 scoli-bucuresti
	chown -R www-data:www-data scoli-bucuresti
EOF
