#!/usr/bin/env bash

source /root/.bashrc

echo -e "${BLUE}--- Create common config ---${NC}"

# Generate Laravel .env file from template .env.docker
if [ ! -f .env ]; then
  cp .env.docker .env
fi