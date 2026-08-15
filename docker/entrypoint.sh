#!/bin/sh
set -e

cat > /var/www/html/.env <<EOF
DB_HOST=$DB_HOST
DB_PORT=$DB_PORT
DB_DATABASE=$DB_DATABASE
DB_USERNAME=$DB_USERNAME
DB_PASSWORD=$DB_PASSWORD
EOF

echo "Waiting for MySQL..."
until mysqladmin ping -h "$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent 2>/dev/null; do
    sleep 1
done
echo "MySQL is ready."

echo "Running migrations..."
mysql -h "$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < /var/www/html/database/migrations/blog.sql
echo "Migrations done."

echo "Running seeds..."
mysql -h "$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < /var/www/html/database/seeds/insert.sql
echo "Seeds done."

exec php-fpm