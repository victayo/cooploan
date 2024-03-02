#!/bin/bash

if [ ! -z "$WWWUSER" ]; then
    usermod -u $WWWUSER sail
fi

if [ ! -d /.composer ]; then
    mkdir /.composer
fi

chmod -R ugo+rw /.composer

echo "Running composer install"
composer install

echo "Running npm install"
npm i

if ["$APP_ENV" == "production"]; then
    npm run build
else
    echo "Running npm for dev"
    npm run dev &
fi

if [ $# -gt 0 ]; then
    exec gosu $WWWUSER "$@"
else
    exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
fi


