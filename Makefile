SHELL := /bin/bash

tests:
	symfony console doctrine:database:drop --force --env=test || true
	symfony console doctrine:database:create --env=test
	symfony console doctrine:migrations:migrate -n --env=test
	symfony console doctrine:fixtures:load -n --env=test
	symfony php bin/phpunit $@
.PHONY: tests

drivers: drivers/chromedriver drivers/geckodriver
.PHONY: drivers

drivers/chromedriver:
	./vendor/bin/bdi driver:chromedriver drivers

drivers/geckodriver:
	./vendor/bin/bdi driver:geckodriver drivers

server:
	sudo docker-compose up -d
	symfony serve -d
