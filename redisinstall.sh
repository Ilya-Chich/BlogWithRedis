composer require predis/predis
sudo apt-get install tcl
wget http://download.redis.io/releases/redis-5.0.5.tar.gz
tar xzf redis-5.0.5.tar.gz
cd redis-5.0.5.tar.gz
make src/redis-server


cd /var/www/html/blog.laravel/ & redis-5.0.5/src/redis-server redis-5.0.5/redis_6369.conf & redis-5.0.5/src/redis-server redis-5.0.5/redis_6379.conf & redis-5.0.5/src/redis-server redis-5.0.5/redis_6389.conf & redis-5.0.5/src/redis-server redis-5.0.5/redis_6360.conf  & redis-5.0.5/src/redis-server redis-5.0.5/redis_6370.conf & redis-5.0.5/src/redis-server redis-5.0.5/redis_6380.conf
