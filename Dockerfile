FROM php:8.2-apache

COPY ./public .

RUN docker-php-ext-install mysqli
