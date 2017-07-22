
# clear the cache
php bin/console cache:clear --env=prod
php bin/console cache:clear

# rebuild the assets
php bin/console assetic:dump --env=prod --no-debug

