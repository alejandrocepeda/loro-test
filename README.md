# Prueba Técnica Loro


## The database schema
<p align="center"><img width="700" src="https://raw.githubusercontent.com/alejandrocepeda/loro-test/master/database-schema.png"></p>


## Usage Steps

### 1. Clone repository
```console
git clone https://github.com/alejandrocepeda/loro-test.git
```

### 2. Copy your .env file:
```console
cd loro-test
cp app/.env.example app/.env
```


### 3. Install and run Docker Compose
```console
sudo curl -L "https://github.com/docker/compose/releases/download/1.26.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

docker-compose up -d
```

### 4. Docker Compose
```console
docker exec -it loro-laravel-php composer install
docker exec -it loro-laravel-php php artisan migrate
docker exec -it loro-laravel-php php db:seed
```

### 4. Finnaly open in your browser http://localhost:8080
