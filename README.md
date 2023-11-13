# yii-picsum-app

Тестовый pet-проект на базе Yii в докер-контейнерах для работы с сервисом картинок https://picsum.photos/
Страница сайта доступна по адресу: http://localhost:82/
Админка: http://admin.localhost:82/
(82 порт - чтобы избежать возможные конфликты с занятым 80 портом)

# Запуск в локальном окружении
- `bash deploy.sh` - для запуска автоматического развертывания проекта с миграциями и созданием пользователя admin/admin

## Прочие команды
- `docker-compose up-d` - для запуска проекта в контейнерах
- `docker-compose down --remove-orphans` - для остановки докер-контейнеров 
- `docker exec -it yii_php bash` - для входа в контейнер или запустите скрипт `run-bash.sh`

### Рестарт Nginx
`docker exec -w ./ yii_nginx nginx -s reload`

### Миграции
Миграции можно откатить с помощью `php yii migrate/down all`
Другие команды:
- `php yii migrate/down` -отменяет самую последнюю применённую миграцию
- `php yii migrate/down 3` -отменяет 3 последних применённых миграции
- `php yii migrate/redo` - перезагрузить последнюю применённую миграцию
- `php yii migrate/redo 3` - перезагрузить 3 последние применённые миграции

# Сброс проекта
`bash reset.sh` - для отката миграций, остановки докер-контейнеров и удаления зависимостей в папке vendor

# Тестирование
## Запуск всех codecept тестов 
`vendor/bin/codecept run` - в контейнере
`docker exec -w /var/www/yii-project/vendor/bin/ yii_php php codecept run`

## Запуск только common тестов 
`vendor/bin/codecept run -- -c common` - в контейнере
`docker exec -w /var/www/yii-project/vendor/bin/ yii_php php codecept run -- -c common`

## Запуск только frontend тестов 
`vendor/bin/codecept run -- -c frontend` - в контейнере
`docker exec -w /var/www/yii-project/vendor/bin/ yii_php php codecept run -- -c frontend`
### Запуск только UNIT тестов
`./vendor/bin/codecept run -- -c frontend unit`

## Запуск только backend тестов
`vendor/bin/codecept run -- -c backend` - в контейнере
`docker exec -w /var/www/yii-project/vendor/bin/ yii_php php codecept run -- -c backend`
### Запуск только UNIT тестов
`./vendor/bin/codecept run -- -c backend unit`

# PhpStan
Для запуска статического анализатора bash

# Gii
http://localhost:82/gii/model