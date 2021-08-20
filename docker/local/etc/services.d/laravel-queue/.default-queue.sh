#!/usr/bin/with-contenv bash
#
# Run Laravel queues
#

# Queue:work good for production mode
php /home/www/app/artisan queue:work --queue=high,default --sleep=2 --tries=3

# Queue:listen good for development mode. It will take performance slow
# Some Laravel version don't support listen
#php /home/www/app/artisan queue:listen --queue=high,default --sleep=2 --tries=3