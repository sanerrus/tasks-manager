# Tasks Manager

### Старт приложения

**ВАЖНО:** 
1. composer-installer.php может измениться и не даст запустить docker контейнер (стр. 12 файла https://github.com/sanerrus/tasks-manager/blob/master/docker/php-fpm/Dockerfile)
2. Подключение к mysql идет через сокет. 
По умолчанию наcтроено что MySQL установлен локально на машине где запускается docker и его unix сокет проброшен в контейнер php-fpm. 
MySQL сокет docker сервера при этом находится в папке `/run/mysqld`. 
Если сокет локальной машины (docker сервера) находится в другой папке, 
то в файле `docker/docker-compose.yml` в секции `php-fpm:` необходимо заменить /run/mysqld:/run/mysqld => \<your path socket\>:/run/mysqld 
3. Пока не решена проблема почему mysql.sock не всегда появляется в контейнере. Если в выводе появляется ошибка связанная с PDO, 
попробуйте перезапустить контейнер

**Требование:**
1.  Docker >19

**предварительная  настройка**

а) в файле hosts локальной машины прописать следующие значения

```
<ip docker serve>   tasks-nanager.local
<ip docker serve>   api.tasks-nanager.local
```
`<ip docker serve>` - IP адрес машины где разворачивается Docker контейнер, если это локальная машина, то 127.0.0.1

б) Настроить схему БД путем заливки DDL схемы (файл ddl.sql)

в) Файл `web/config/config.yaml.example` переименовать в `web/config/config.yaml`

в) Настроить параметры подключения к БД в файле `web/config/config.yaml`

г) Настроить параметр окружающей среды в файле `web/config/config.yaml`

**запуск**
```
cd docker/
docker-compose up --build
```
web приложение станет доступно по url http://tasks-manager.local/

---
### Docker

Используются образы:<br>
1. nginx:alpine<br>
2. php:7.4.0-fpm-alpine3.10

---
### DataBase

1. DDL - скрипт ddl.sql (По умолчанию создается БД tasks. Таблицы `task_statuses` и `users` изначально заполнены тестовыми данными т.к. в рамках данной задачи функционал для работы с пользователями и статусами задач не предусмотрен.)
2. ER модель - файл ER.png 

---
### Используемые библиотеки/технологии
1. Контейнер - **bitexpert/disco** (https://github.com/bitExpert/disco)
2. Механизм внедрение зависимостей - собственная ревлизация
2. Работа с БД (ORM) - **Doctrine**
3. Router - **league/route** (https://github.com/thephpleague/route)
4. Request and Response - **laminas/laminas-diactoros** (https://github.com/laminas/laminas-diactoros) 
5. emitter - **narrowspark/http-emitter** (https://github.com/narrowspark/http-emitter)

---
### Качество кода

1. allysonsilva/php-pre-commit - установленн pre-commit (https://github.com/allysonsilva/php-pre-commit). Подкорректированный файл в корне проекта `pre-commit` необходимо копировать в папку `.git/hooks/`
2. phpstan/phpstan - установлен статический анализатор кода (https://github.com/phpstan/phpstan)
3. тесты - папка tests

---
### Развитие системы

1. Авторизация
2. Ролевая модель
3. Управление пользователями
4. Управление статусами
5. ДОбавление проектов и связка задач с проектами
6. Настройка workflow для проектов
