## Install project

Run command 
```bash
composer install && npm install
```
Create database and create .env file

Run command
```bash
php artisan migrate --seed && php artisan passport:install && npm run prod
```

Start project

```bash
php artisan serve
```
