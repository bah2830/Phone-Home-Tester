FROM php:7.0-apache

RUN apt-get update && apt-get install sqlite3 -y

RUN mkdir /database
RUN chown -R www-data:www-data /database

COPY src/ /var/www/html/
COPY setup/ /setup

USER www-data
RUN sqlite3 /database/request_logger.db < /setup/bootstrap_db.sql
USER root
