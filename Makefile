.PHONY: build start stop restart database

build:
	docker-compose build

start: build
	docker compose up --detach

stop:
	docker-compose down --remove-orphans --volumes --timeout 0
restart: stop start
