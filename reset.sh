#!/bin/sh

# Откат миграций
docker exec -w /var/www/yii-project yii_php php yii migrate/down all --interactive=0

# Остановка docker-контейнеров
docker-compose down --remove-orphans

# Установка зависимостей Composer
rm -R www/yii-project/vendor



