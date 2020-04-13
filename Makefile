DOCKER_COMPOSE		= docker-compose
DOCKER_COMPOSE_RUN = $(DOCKER_COMPOSE) run --rm
BASH  = $(DOCKER_COMPOSE) exec php-fpm sh

##
###------------#
###    Help    #
###------------#
##

.DEFAULT_GOAL := 	help

help:				## DEFAULT_GOAL : Display help messages from parent Makefile
					@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-20s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

.PHONY: 			help

##
###----------------------------------#
###    Project commands (Docker)     #
###----------------------------------#
##

build:				./docker-compose.yml ./docker-compose.override.yml.dist ## Build Docker images
					@echo '\033[1;42m/!\ In case of a build error, relaunch the builder. All the Docker stack is functional, take a look on your own configuration.\033[0m';
					@if [ -f ./docker-compose.override.yml ]; \
            		then \
            			echo '\033[1;41m/!\ The ./docker-compose.override.yml already exists. So delete it, if you want to reset it.\033[0m'; \
            		else \
            			cp ./docker-compose.override.yml.dist ./docker-compose.override.yml; \
            		   	echo '\033[1;42m/!\ The ./docker-compose.override.yml was just created. Feel free to put your config in it.\033[0m'; \
            		fi
					$(DOCKER_COMPOSE) pull --quiet --ignore-pull-failures 2> /dev/null
					$(DOCKER_COMPOSE) build --force-rm --compress

start:				## Start all containers
					$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop:				## Stop all containers
					$(DOCKER_COMPOSE) stop

down:				## down all containers
					$(DOCKER_COMPOSE) down

install:			build start  ## Launch project : Build Docker

kill:				## Kill Docker containers
					$(DOCKER_COMPOSE) kill
					$(DOCKER_COMPOSE) down --volumes --remove-orphans

php:				## Remove all images (<none> too)
					$(BASH)

phpstan:
					$(DOCKER_COMPOSE_RUN) php-fpm symfony/vendor/bin/phpstan analyse -l 8 symfony/src

phpcsfixer:
					$(DOCKER_COMPOSE_RUN) php-fpm symfony/vendor/bin/php-cs-fixer fix --config=symfony/.php_cs.dist