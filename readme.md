##Тестовое от Simbirsoft
«FileStorage (backend)»
=====================

## Установка
1. Установить менеджер зависимостей composer.
2. Скачать проект с GitHub и распаковать (https://github.com/stzv78/filestorage.git)
3. Перейти в папку проекта и выполнить команду composer install.
4. Скопировать информацию файла  .env.example  в  .env:
  (cp .env.example .env)
5. Установить ключ в файл среды: php artisan key:generate 
6. Создать базу данных на удаленном хостинге и указать настройкии доступ в .env:  
DB_DATABASE – имя базы данных, 
DB_USERNAME – пользователь, 
DB_PASSWORD – пароль.
7. Указать в .env параметры для отправки e-mail:
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME= пользователь
MAIL_PASSWORD= пароль пользователя
MAIL_ENCRYPTION=ssl
8. Выполнить симлинк на папку c сохраняемыми файлами - php artisan storage:link
9. Запустить миграции php artisan migrate --seed
8. Выполнить симлинк на папку проекта – public:
$ ln -s  /path/to/site/public  /path/to/site/public_html

Далее зарегистрироваться и использовать. 
P.S. 
После Faker-загрузки первоначальных данных в базу пришлось немного сломать синхронизацию файлов на диске и в базе.
В этой версии задания - зарегистрированный пользователь загружает файлы. Этот маршрут подлежит исключению в следующей версии с фронтендом.


