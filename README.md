# php-project-lvl4
[![Maintainability](https://api.codeclimate.com/v1/badges/2177a7c287a4880828c7/maintainability)](https://codeclimate.com/github/InfluxOW/php-project-lvl4/maintainability)
![PHP CI](https://github.com/InfluxOW/php-project-lvl4/workflows/PHP%20CI/badge.svg)
[![Test Coverage](https://api.codeclimate.com/v1/badges/2177a7c287a4880828c7/test_coverage)](https://codeclimate.com/github/InfluxOW/php-project-lvl4/test_coverage)

[https://influx-task-manager.herokuapp.com/](https://influx-task-manager.herokuapp.com/)

**Hexlet.io fourth PHP project** \
Description: https://ru.hexlet.io/professions/php/projects/57

# Development Setup
1. Run `make setup` to install dependencies, generate .env file, create SQLite database, apply migrations.
2. Run `make seed` if you want to seed the database.
3. Fill `.env` keys that are responsible for e-mail sending and AWS connection (they starts with MAIL_ and AWS_). Set `APP_DEBUG` as `true` if you want Debugbar to be enabled.
4. Run `make run` to launch web server (http://localhost:8000).
5. Run `make queue` to process the job queue.
6. Run `make lint test` to run linter and tests.
# Heroku Setup
1. Add Heroku Postgres addon.
2. Set all necessary `.env` keys.
3. Run `heroku ps:scale web=1 sqs=1 --app your-heroku-app`
