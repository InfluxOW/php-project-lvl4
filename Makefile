start:
	heroku local -f Procfile.dev

setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:generate
	touch database/database.sqlite || true
	php artisan migrate
	npm install

serve:
	php artisan serve

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

test-coverage:
	composer exec --verbose phpunit -- --coverage-clover build/logs/clover.xml

deploy:
	git push heroku

lint:
	composer exec --verbose phpcs

lint-fix:
	composer exec --verbose phpcbf

meta:
	php artisan ide-helper:generate
	php artisan ide-helper:models -n -W -R
	php artisan ide-helper:meta

queue:
	php artisan queue:work --queue=high,default,low --timeout=1800

clear:
	php artisan route:clear
	php artisan view:clear
	php artisan cache:clear
	php artisan config:clear
