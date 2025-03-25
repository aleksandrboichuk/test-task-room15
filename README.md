# Тестове завдання

### Розгортання проєкту:
- Перейти у робочу директорію та виконати наступні команди в консолі:
    + `git clone https://github.com/aleksandrboichuk/test-task-room15.git` - клонування проєкту у робочу директорію
    + `cd test-task-room15`
    + `cp .env.example .env ` - копіювання конфігураційних файлів для laravel
    + `cd docker && cp docker-compose.example.yml docker-compose.yml && cp .env.example .env` - копіювання конфігураційних файлів для docker-compose
    + `docker-compose build && docker-compose up -d` - білд та підняття контейнерів
    + `docker-compose exec php-fpm bash` - перехід у php-fpm контейнер для встановлення композеру (та виконання в майбутньому artisan команд)
    + `composer install` - встановлення composer
    + `php artisan migrate --seed` - виконання міграцій та заповнення тестовими данними БД
    + `npm install && npm run dev` - vite
    + `php artisan test` - виконання PHPUnit тестів

Проєкт має бути доступним за посиланням http://localhost

Мейлер (всі відправлені листи) знаходяться за посиланням http://localhost:8025
