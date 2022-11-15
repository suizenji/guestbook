SHELL := /bin/bash
APP_ENV := test

all: db test

db:
	symfony console doctrine:database:drop --force --env=$(APP_ENV) || true
	symfony console doctrine:database:create --env=$(APP_ENV)
	symfony console doctrine:migrations:migrate -n --env=$(APP_ENV)
	symfony console doctrine:fixtures:load -n --env=$(APP_ENV)

test: drivers
	symfony php bin/phpunit tests

drivers: drivers/chromedriver drivers/geckodriver

drivers/chromedriver:
	./vendor/bin/bdi driver:chromedriver drivers

drivers/geckodriver:
	./vendor/bin/bdi driver:geckodriver drivers

server:
	sudo docker-compose up -d
	symfony serve -d
	symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async -vv
