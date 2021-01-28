# docker-php-fpm

Docker with php-fpm + mysql + nginx

## The architecture of the environment
<p align="center"><img width="700" src="https://miro.medium.com/max/2168/0*kvwkBaoVnwbjqX8M.png"></p>


# Directory structure
```bash
.
├── app / 
├── nginx / 
│   ├── conf.d /
│   │   └── default.conf
│   └── nginx.conf
├── php-fpm / 
│   └── Dockerfile
├── mysql / 
├── .env 
└── docker-compose.yml 
```

## Usage Steps

### 1. Open your .env file and change:
```
# MYSQL VARIABLES
MYSQL_ROOT_PASSWORD=root
MYSQL_USER=user
MYSQL_USER_PASSWORD=user
MYSQL_DB=youdbname
MYSQL_VERSION=5.7
MYSQL_PORT_HOST=3308
MYSQL_DATA_PATH=./mysql
MYSQL_CONTAINER_NAME=laravel-mysql

# PHP VARIABLES
PHP_CODE_PATH=./app
PHP_HOST_PORT=9000
PHP_CONTAINER_NAME=laravel-php

# NGINX VARIABLES
NGINX_CONF_PATH=./nginx/conf.d
NGINX_PORT=8088
NGINX_CONTAINER_NAME=laravel-nginx
```

### 2. Open your .env file and change:
```
Copy your php file into ./app folder
```

### 3. Docker Compose
```console
sudo curl -L "https://github.com/docker/compose/releases/download/1.26.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose up -d
```

### 4. Copy your php files or laravel project into ./app


### 5. Finnaly open in your browser http://localhost:8088
