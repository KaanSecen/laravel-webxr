SAIL_DIR := ./vendor/bin/sail
install:
	@make build
	@make up
	@make composer-install
down:
	$(SAIL_DIR) down
build:
	$(SAIL_DIR) build --no-cache
up:
	$(SAIL_DIR) up -d
	sleep 2
	open http://localhost
composer-install:
	$(SAIL_DIR) composer install
composer-update:
	$(SAIL_DIR) composer update
composer-require:
	@read -p "Enter package name: " package; \
	if ! $(SAIL_DIR) composer require $$package; then \
		echo "Package $$package not found."; \
	fi
composer-remove:
	@read -p "Enter package name: " package; \
	if ! $(SAIL_DIR) composer remove $$package; then \
		echo "Package $$package not found."; \
	fi
migrate-seed:
	$(SAIL_DIR) php artisan migrate
	$(SAIL_DIR) php artisan db:seed
migrate:
	$(SAIL_DIR) php artisan migrate
seed:
	$(SAIL_DIR) php artisan db:seed
cache-clear:
	$(SAIL_DIR) php artisan cache:clear
view-clear:
	$(SAIL_DIR) php artisan view:clear
route-clear:
	$(SAIL_DIR) php artisan route:clear
config-clear:
	$(SAIL_DIR) php artisan config:clear
clear-all:
	@make cache-clear
	@make view-clear
	@make route-clear
	@make config-clear
test:
	$(SAIL_DIR) php artisan test
build-production:
	$(SAIL_DIR) build --no-cache --env=prod
logs:
	$(SAIL_DIR) tail -f storage/logs/laravel.log
