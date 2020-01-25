# Tasks Manager

### Старт приложения

**ВАЖНО:** composer-installer.php может измениться и не даст запустить docker контейнер 

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

1. DDL - скрипт ddl.sql (По умолчанию создастся БД tasks, таблицы task_statuses и users стазу заполнены тестовыми данными т.к. в рамках данной задачи функционал для этого не предусмотрен.)
2. ER модель - файл ER.png 

---
### Используемые библиотеки
1. Внедрение зависимостей - **bitexpert/disco** (https://github.com/bitExpert/disco)
2. 

---
### Качество кода

1. allysonsilva/php-pre-commit - установленн pre-commit (https://github.com/allysonsilva/php-pre-commit). Подкорректированный файл `pre-commit` необходимо копировать в папку `.git/hooks/`
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
 
