*News test work*

Установка:

1. Зависиомсти
    ```bash
        composer install
    ```
2. .env

    * создаем файл окружения
    ```bash
        cp .env.example .env
    ```
    * генерируем токен
    ```bash
       php artisan key:generate
    ```
    * Прописываем ключи рекапчи
        ```bash
            NOCAPTCHA_SECRET=
            NOCAPTCHA_SITEKEY=
        ```
    * указываем парамметры бд

3. Миграции

    ```bash
        php artisan migrate
    ```

4. Сиды

    ```bash
        php artisan db:seed --class=DefaultUser
        php artisan db:seed --class=DefaultAvatar
    ```
5. Создаем 30 записей
    
     ```bash
         php artisan tinker
     ```
    ```php
        create(\News\News::class, 30)->create();
    ```
6. Симлинки хранилища
    ```bash
       php artisan storage:link
    ```
7. Собираем фронтенд
    ```bash
        cd ./public/frontend && npm i && npm run build
    ```
8. Результат:
![alt text](https://pp.userapi.com/c850128/v850128419/627be/cxk_YOnUA_4.jpg)
