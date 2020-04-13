test:
	php artisan test
install:
	composer install
run:
	php artisan serve
lint:
	composer run-script phpcs -- --standard=PSR12 routes tests app
setup: install
	cp -n .env.example .env || true
	php artisan key:generate
	touch database/database.sqlite
	php artisan migrate
	php artisan storage:link
seed:
	php artisan db:seed
queue:
	php artisan queue:work --queue=high,default,low --timeout=1800
