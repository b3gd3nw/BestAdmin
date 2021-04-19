## Руководство по установке веб приложения "Best Admin"

1. Програмное обеспечение:
    - PHP
    - Laravel
    - MySQL
    - Composer
    - Nodejs
    - npm
2. Установка:
    1. Создаем базу данных в MySQL. Заходим в консоль MySQl -  create database Users_db.
    2. Устанавливаем все зависимости npm install && composer install
    3. Собираем проект npm run prod
    4. Создаем файл в проекте .env по примеру .env.example. Настраиваем подключение к БД MySQL и подключение к Mailgun.
    5. Делаем миграции всех таблиц php artisan migrate
    6. Включаем сиды для заполнения таблицы countries и создания аккаунта админа php artisan db:seed
    7. Устанавливаем ключ шифрования сессий и кук php artisan key:generate

   ### Endpoints

   | point  | value |
   | ------------- | ------------- |
   | / | Welcome page  |
   | /admin | Admin panel  |
   | /register/{token} | Employee register page |
   
   ***
   
   | Admin login  | Admin password |
   | ------------- | ------------- |
   | admin@gmail.com | admin  |

    ****
   Всё готово.
    