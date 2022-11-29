Simple Application for candidate testing
========================================

 ## ENVIRONMENT:
- sudo apt install mysql-server
- sudo apt install apache2
- sudo apt install php8.1

## Commands:

# With cron
- composer install
- sudo apt install redis-server
- sudo apt install memcached libmemcached-tools
- sudo apt install php-memcached
- sudo apt install apache2 php libapache2-mod-php php-memcached php-cli
- systemctl restart apache2/nginx
- crontab -e
- * * * * * php /path-to-your-project/kernel.php >/dev/null 2>&1
- systemctl start redis
- systemctl start cron

# Without cron
- just start /kernel.php to execute cron script object

# Routes
- /v1/items
- /v1/item

# Recommended testing for app status
- before start and check routes, open a terminal,
execute command redis cli FLUSHALL
- after that go to routes and check network F12, you will see request response in miliseconds for /v1/items route,
second time after you checked response, now you will see so much lower time response, because in second http request we get response not from database or API from redis cache...

# ENJOY