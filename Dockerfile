FROM php:8.1.18-apache-buster
# Instalar extensão MySQLi
RUN docker-php-ext-install mysqli

# Configurar o diretório de trabalho
WORKDIR /var/www/html

# Copiar o conteúdo do diretório local para o contêiner
COPY . /var/www/html
