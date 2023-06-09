    /*
Для развертывания и запуска приложения с помощью контейнеров используется Docker.
Устанавливаем последнюю версию, и информацию по установке берем из официальной документации, по ссылке https://docs.docker.com/install/linux/docker-ce/ubuntu
Процесс установки Docker можно разбить на несколько шагов:
1. Обновляем пакеты Ubuntu

sudo apt-get update
2. Устанавливаем необходимые зависимости

sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common
3. Добавляем официальный ключ

curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
И сравниваем отпечаток:

sudo apt-key fingerprint 0EBFCD88
4. Добавляем репозиторий где расположен Docker

sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"
5. Обновляем индекс пакетов apt

sudo apt-get update
6. Установка Docker

sudo apt-get install docker-ce docker-ce-cli containerd.io
7. Убеждаемся, что Docker CE установлен правильно, запустив образ hello-world.

sudo docker run hello-world
    */

    /*
8. Через образ composer смонтируем каталоги проекта Laravel
docker run --rm -v $(pwd):/app composer install
Опции -v и –rm в команде docker run создают контейнер, который привязывается к текущему каталогу до тех пор, пока он не будет удален. 
Содержимое каталога ~/laravel-app скопируется в контейнер, а содержимое папки vendor, которую Composer создает внутри контейнера, будет скопировано в текущий каталог.
9. Отредактируем привилегии каталога, все права на него нужно передать пользователю sudo
sudo chown -R $USER:$USER ~/laravel-app
Это нужно для того, чтобы запускать процессы в контейнере через пользователя sudo
10. Создание конфигурационного файла Docker Compose
Сборка приложений с помощью Docker Compose упрощает настройку и контроль версий в инфраструктуре. 
Настройка приложения осуществляется в файле docker-compose.yml, в котором определяются сервисы веб-сервера, базы данных и приложения.
В файл входят следующие сервисы:
• app: определение сервиса, которое содержит приложение Laravel и запускает кастомный образ Docker, его мы определим позже. Также оно присваивает значение /var/www для параметру working_dir в контейнере.
• webserver: загружает образ nginx:alpine и открывает порты 80 и 443.
• db: извлекает образ mysql:5.7.22 и определяет новые переменные среды, в том числе имя базы данных для приложения и пароль пользователя root этой БД. Это определение также связывает порт хоста 3306 и такой же порт контейнера .
Свойство container_name определяет имя контейнера, которое должно совпадать с именем сервиса. Если вы не определите это свойство, Docker будет присваивать контейнерам случайные имена (по умолчанию он выбирает имя исторической личности и случайное слово, разделяя их символом подчеркивания).
Для простоты взаимодействия между контейнерами сервисы подключаются к соединительной сети app-network. 
Соединительная сеть использует программный мост, который позволяет подключенным к этой сети контейнерам взаимодействовать друг с другом. Драйвер устанавливает правила хоста автоматически, чтобы контейнеры из разных соединительных сетей не могли взаимодействовать напрямую. Это повышает безопасность приложений, поскольку взаимодействовать в таких условиях смогут только связанные сервисы.
11. Постоянное хранение данных
• Docker предоставляет удобные средства для постоянного хранения данных. Для этого в данном приложении мы будем использовать тома и монтируемые образы. 
• Для постоянного сохранения базы данных MySQL определяем том dbdata в файле docker-compose.yml, в определении сервиса db
• Том dbdata используется для постоянного сохранения содержимого /var/lib/mysql в контейнере. Это позволяет останавливать и перезапускать сервис db, не теряя данных. В конце файла определяем том dbdata
• Теперь можно использовать этот том для разных сервисов. Затем добавим к сервису db привязку монтируемого образа для конфигурационных файлов MySQL. Это привяжет файл ~/laravel-app/mysql/my.cnf к каталогу /etc/mysql/my.cnf в контейнере.
• Добавим монтируемые образы в сервис webserver. Образов будет два: один для кода приложения, а второй — для определения настроек Nginx.
• Первый образ привязывает код приложения из каталога ~/laravel-app к каталогу /var/www внутри контейнера. Конфигурационный файл, добавляемый в ~/laravel-app/nginx/conf.d/, также монтируется в папку /etc/nginx/conf.d/ в контейнере, что позволяет менять содержимое каталога по мере необходимости.
• Теперь добавим следующие привязки образов в сервис app для кода приложения и конфигурационных файлов.
• Теперь создаем пользовательский образ приложения в файле Dockerfile, который должен находится в корневой папке проекта.

*/
