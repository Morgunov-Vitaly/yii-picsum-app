# yii-picsum-app

Тестовый pet-проект на базе Yii в докер-контейнерах для работы с сервисом картинок https://picsum.photos/

# Запуск в локальном окружении
- `bash deploy.sh` - для запуска автоматического развертывания проекта
- `docker-compose up-d` - для запуска проекта в контейнерах
- `docker-compose down --remove-orphans` - для остановки докер-контейнеров 
- `docker exec -it yii_php bash` - для входа в контейнер или запустите скрипт `run-bash.sh`

### Миграции
Миграции можно откатить с помощью `php yii migrate/down all`
Другие команды:
- `php yii migrate/down` -отменяет самую последнюю применённую миграцию
- `php yii migrate/down 3` -отменяет 3 последних применённых миграции
- `php yii migrate/redo` - перезагрузить последнюю применённую миграцию
- `php yii migrate/redo 3` - перезагрузить 3 последние применённые миграции

# Сброс проекта
`bash reset.sh` Для отката миграций, остановки докер-контейнеров и удаления зависимостей в папке vendor 

# Рестарт Nginx
`docker exec -w ./ yii_nginx nginx -s reload`