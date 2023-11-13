#!/bin/sh

# Запуск всех codecept тестов
docker exec -w /var/www/yii-project/vendor/bin/ yii_php php codecept run --bootstrap