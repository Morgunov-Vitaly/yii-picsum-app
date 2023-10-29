#!/bin/sh

# Запуск приложения в докере
docker-compose up -d

# Установка зависимостей Composer
docker exec -w /var/www/yii-project yii_php composer install

# Запуск миграций
docker exec -w /var/www/yii-project yii_php php yii migrate --interactive=0

# Создаем админа
docker exec -w /var/www/yii-project yii_php php yii local/add-admin-user

