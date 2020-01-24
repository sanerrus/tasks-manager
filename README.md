# ktTeam

### Docker

**ВАЖНО:** composer-installer.php может измениться и не даст запустить docker контейнер 

**используемые контейнеры/технологи**<br>
alpine, nginx + php-fpm. Со временем можно перевести на RoadRunner

**требования**
<br>
в файле hosts прописать следующие значения
<br>
127.0.1.1   tasks-nanager.local
<br>
127.0.1.1   api.tasks-nanager.local

**запуск**
<br>
cd docker/
<br>
docker-compose up --build
<br>
после чего web приложение станет доступно по url tasks-nanager.local


### DataBase

Необходимо применить скрипт ddl.sql к СУБД. По умолчанию создастся БД tasks, таблицы task_statuses и users стазу заполнены тестовыми данными т.к. в рамках данной задачи функционал для этого не предусмотрен.
 
