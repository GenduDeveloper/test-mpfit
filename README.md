# Тестовое задание для PHP-разработчика от компании MPFIT

Веб-приложение для управления товарами и заказами.

ТЗ: https://docs.google.com/document/d/1AS9WeZz6Ak9eS5u2UtrRUGcJs1TKskcpH7faURtSaZY/edit?tab=t.0

# Разворачивание проекта

1. Клонируем репозиторий: git clone https://github.com/GenduDeveloper/test-mpfit.git
2. composer install в корне проекта
3. Переименовываем .env.example в .env и настраиваем подключение к БД
4. php artisan migrate
5. Накатываем тестовые данные: php artisan db:seed
6. php artisan serve

Коллекцию Postman можно скачать из: `/app/PostmanCollections`


