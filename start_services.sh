#!/bin/bash
# Start MySQL
service mysql start

# Initialiser la base de données
if [ -d "/docker-entrypoint-initdb.d" ]; then
    for file in /docker-entrypoint-initdb.d/*; do
        case "$file" in
            *.sh)  echo "$0: running $file"; . "$file" ;;
            *.sql) echo "$0: running $file"; mysql < "$file"; echo ;;
            *)     echo "$0: ignoring $file" ;;
        esac
    done
fi

# Start PHP-FPM
service php8.1-fpm start

# Start Nginx
nginx -g 'daemon off;'
