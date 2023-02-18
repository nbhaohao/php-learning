FROM php:8.0.2-fpm

RUN sed -i "s@http://\(deb\|security\).debian.org@https://mirrors.ustc.edu.cn@g" /etc/apt/sources.list
RUN apt-get update
RUN apt-get install git curl zip unzip -y

WORKDIR /var/www