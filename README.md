## Запустить контейнеры
`docker-compose up -d`

## в докере:

### Скопировать .env файл

`docker exec laravel_app cp .env.example .env`

### Сгенерировать ключ шифрования

`docker exec laravel_app php artisan key:generate`

### Установить свой API ключ в .env файле. Параметр API_KEY

Можно оставить текущий.

### Мигрировать базу

`docker exec laravel_app php artisan migrate`

### Заполнить базу тестовыми данными

`docker exec laravel_app php artisan db:seed`

### Приложение

http://localhost:8000

### Документация

http://localhost:80000/api//documentation

Можно запускать API запросы из postman (запросы в файле organization_exercise.postman_collection.json),
а можно из swagger

## Опционально

### Сгенерировать документацию

`docker exec laravel_app php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"`
`docker exec laravel_app php artisan l5-swagger:generate`
