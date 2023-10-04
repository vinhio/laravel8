# Laravel 8.x and docker image `vinhio/php8`

Step by step create Laravel 8.x project from scratch base on docker image `vinhio/php8`

Need to review docker image at https://hub.docker.com/r/vinhio/php8 to understand the application environment and PHP plugins pre-installed in the image.

Docker compose `docker/docker-compose.yml` declared 4 instances:

    - Web instance PHP 8.0.9
    - Database instance MySQL 8.0.25
    - Caching instance Redis 5.3.4
    - MailServer instance Mailhog 1.0.1

Note: Mail to me `vohuynhvinh@gmail.com` if you get any issue.

## I. Install with existing Laravel code

### 1. Add docker files to Laravel code

Copy `docker` folder and `Makefile` to LARAVEL_FOLDER

    docker
        |_/customize
        |_/local
        |_docker-compose.yml
        |_Dockerfile.local
        |_Dockerfile.nodejs
    Makefile

So, folder structure

    /LARAVEL_FOLDER
        |_/app 
        |_/bootstrap
        |_/config
        |_/database
        |_/docker (*)
            |_/customize
            |_/local
            |_docker-compose.yml
            |_Dockerfile.local
            |_Dockerfile.nodejs
        |_Makefile (*)
        |_.....
        |_.env
        |_artisan
        |_...


### 2. Build docker images

Build docker images

    #make build

Check make sure `laravel8-web` docker image was created

    #docker images | grep laravel8-web

### 3. Run application

Run make command `start` to start docker containers

    #make start

Check docker containers

    #docker ps
    ...
    CONTAINER ID   IMAGE                     COMMAND                  CREATED         STATUS                   PORTS                                                                            NAMES
    14146afab62f   laravel8-web              "/init"                  6 minutes ago   Up 6 minutes             0.0.0.0:8080->80/tcp, :::8080->80/tcp, 0.0.0.0:8443->443/tcp, :::8443->443/tcp   laravel8-web
    57d53fe2eff1   mysql:8.0.25              "docker-entrypoint.s…"   6 minutes ago   Up 6 minutes (healthy)   33060/tcp, 0.0.0.0:33060->3306/tcp, :::33060->3306/tcp                           laravel8-db
    398098dd8dfa   redis:6.2.5-alpine3.14    "docker-entrypoint.s…"   6 minutes ago   Up 6 minutes             6379/tcp                                                                         laravel8-redis
    e80c313a79da   mailhog/mailhog:v1.0.1    "MailHog"                6 minutes ago   Up 6 minutes             1025/tcp, 0.0.0.0:8025->8025/tcp, :::8025->8025/tcp                              laravel8-mail

Take a look log container `laravel8-web`

    #make logs

### 4. Checking

- Web Server http://localhost:8080/
- Mail Server http://localhost:8025/

## II. Install new Laravel project

### 1. Build docker images

Build docker images

    #make build

Check make sure `laravel8-web` docker image was created

    #docker images | grep laravel8-web

Note: We can update all docker files and rebuild in development phrase.

### 2. Start app
#### a. Start docker

    #make start

    Creating laravel8-mail  ... done
    Creating laravel8-redis ... done
    Creating laravel8-db    ... done
    Creating laravel8-web   ... done


#### b. Check status:
Check via HTTP

- Web Server http://localhost:8080/phpinfo.php
- Mail Server http://localhost:8025/

Check via Command line:

    #docker ps
    ...
    CONTAINER ID   IMAGE                     COMMAND                  CREATED         STATUS                   PORTS                                                                            NAMES
    14146afab62f   laravel8-web              "/init"                  6 minutes ago   Up 6 minutes             0.0.0.0:8080->80/tcp, :::8080->80/tcp, 0.0.0.0:8443->443/tcp, :::8443->443/tcp   laravel8-web
    57d53fe2eff1   mysql:8.0.25              "docker-entrypoint.s…"   6 minutes ago   Up 6 minutes (healthy)   33060/tcp, 0.0.0.0:33060->3306/tcp, :::33060->3306/tcp                           laravel8-db
    398098dd8dfa   redis:6.2.5-alpine3.14    "docker-entrypoint.s…"   6 minutes ago   Up 6 minutes             6379/tcp                                                                         laravel8-redis
    e80c313a79da   mailhog/mailhog:v1.0.1    "MailHog"                6 minutes ago   Up 6 minutes             1025/tcp, 0.0.0.0:8025->8025/tcp, :::8025->8025/tcp                              laravel8-mail

Check Web server environment:

Go into Web instance

    #make shell
    laravel8-web ~/app $ php -v | grep PHP
    laravel8-web ~/app $ composer -v | grep 'Composer version'

### 3. Install Laravel 8.x

Let keep your PC/Mac refresh with PHP/Composer and stuff for development. So, I don't recommend adding PHP's stuff to your PC/Mac
. So, Install Laravel inside instance `laravel8-web` is good solution.

Don't for get Go into Web instance (Note: Remember it for each time to add/remove any PHP Composer package)

    #make shell

#### Install Laravel:

You should follow step at https://laravel.com/docs/8.x

    laravel8-web ~/app $ composer create-project --prefer-dist laravel/laravel tmp_app "8.*"
    laravel8-web ~/app $ mv tmp_app/public/* ./public/ && rm -fr tmp_app/public && rm -fr tmp_app/README.md && mv tmp_app/* . && mv tmp_app/.env.example . && mv tmp_app/.gitattributes . && rm -fr tmp_app

### 4. Restart docker

    #make stop && make start

Take a look log container `laravel8-web` (Because the first time run app will take a while)

    #make logs

Check via HTTP

- Web Server http://localhost:8080/
- Mail Server http://localhost:8025/
