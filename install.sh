#!/bin/sh

#sudo apt-get update

echo "----------------------------------------"
echo "[Installing PHP XMLRPC library]"
echo "----------------------------------------"
sudo apt-get install -y php5-xmlrpc

echo "----------------------------------------"
echo "[Installing Supervisor]"
echo "----------------------------------------"
sudo apt-get install -y python-setuptools
sudo easy_install supervisor
[ -d log ] || mkdir log && chmod 777 log

echo "----------------------------------------"
echo "[Installing Twiddler]"
echo "----------------------------------------"
[ -d vendor ] || mkdir vendor
[ -d vendor/twiddler ] || git clone --depth=100 --quiet git://github.com/waptang/supervisor_twiddler.git vendor/twiddler
cd vendor/twiddler
sudo python setup.py install
cd ../../

echo "----------------------------------------"
echo "[Installation Complete]"
echo "----------------------------------------"
echo "Version:" $(supervisord -v)

echo "----------------------------------------"
echo "[Installing Dependencies]"
echo "----------------------------------------"
curl -s http://getcomposer.org/installer | php
php composer.phar update
php composer.phar install
echo