#!/usr/bin/with-contenv bash

source /root/.bashrc
echo -e "${BLUE}--- Init Laravel application ---${NC}"

# Remove configs cache, if exists
rm -f bootstrap/cache/*.php

# Generate app token and stuff
if [ -z $(grep "APP_KEY=base64:*" .env) ]; then
  echo -e "${YELLOW}Application key was not set yet, generating new one${NC}"
  # Generate app key
  php artisan key:generate

  # Generate JWT key
  echo -e "${YELLOW}Try to generate JWT key${NC}"
  php artisan jwt:secret --force

  # Create backup file
  cp -f .env .env.docker
fi

echo -e "${YELLOW}Re-build config, route, api, cache${NC}"
# Update config and routes cache
php artisan config:cache
php artisan route:cache
php artisan api:cache
php artisan cache:clear