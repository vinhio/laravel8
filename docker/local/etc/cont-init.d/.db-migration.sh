#!/usr/bin/with-contenv bash

source /root/.bashrc
echo -e "${BLUE}--- Run Database migrations ---${NC}"

### Run migrations
php artisan migrate --force