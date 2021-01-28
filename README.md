# Prueba Técnica Loro

## The database schema
<p align="center"><img width="700" src="https://raw.githubusercontent.com/alejandrocepeda/loro-test/master/database-schema.png"></p>

## Demo
<a href="https://caballosenlinea.com" target="_blank" rel="noopener"><span>Loro Test</span> </a>.

## Install Steps

### 1. Clone repository
```console
git clone https://github.com/alejandrocepeda/loro-test.git
```

### 2. Copy your Laravel .env file & Permissions:
```console
cd loro-test
cp app/.env.example app/.env
chmod -R 777 app/storage
```

### 3. Install & run Docker Compose
```console
sudo curl -L "https://github.com/docker/compose/releases/download/1.26.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

docker-compose up -d
```

### 4. Run composer install & Laravel migrations and seeders
```console
sudo docker exec -it loro-laravel-php composer install
sudo docker exec -it loro-laravel-php php artisan migrate
sudo docker exec -it loro-laravel-php php artisan db:seed
```

### 5. Finnaly open in your browser http://localhost:8080
