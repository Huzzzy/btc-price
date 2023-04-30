## Последовательность действий, чтобы развернуть приложение при помощи Docker

- Переименовать .env.example в .env

- composer install
- npm install

- docker-compose build
- docker-compose up -d

- php artisan key:generate

- sudo chmod 777 -R storage 

- docker exec -it btc_price_app bash
- php artisan migrate --seed
- php artisan schedule:work 

В новом терминале 
- npm run dev


## [Приложение](http://localhost:8080)
