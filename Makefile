PWD = $(shell pwd)

all: build run

build:
	docker-compose -f docker/docker-compose.yml build --no-cache --build-arg hostUID=1000 --build-arg hostGID=1000 web
	docker-compose -f docker/docker-compose.yml build --no-cache static

start: run

run:
	docker-compose -f docker/docker-compose.yml -p iamlaravel up -d web

stop:
	docker-compose -f docker/docker-compose.yml -p iamlaravel kill

destroy:
	docker-compose -f docker/docker-compose.yml -p iamlaravel down

logs:
	docker-compose -f docker/docker-compose.yml -p iamlaravel logs -f web

shell:
	docker-compose -f docker/docker-compose.yml -p iamlaravel exec --user nginx web bash

root:
	docker-compose -f docker/docker-compose.yml -p iamlaravel exec web bash

ip:
	docker inspect iamlaravel-web | grep \"IPAddress\"

static_install:
	docker run -it -v "${PWD}:/build" static-builder npm --loglevel=error install

static:
	docker run -it -v "${PWD}:/build" static-builder npm --loglevel=error run dev

static_watch:
	docker run -it -v "${PWD}:/build" static-builder npm --loglevel=error run watch
