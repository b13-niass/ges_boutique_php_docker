# Utiliser une image de base Ubuntu 22.04
FROM ubuntu:22.04

# Définir le mainteneur de l'image
LABEL maintainer="barhamadieng66@gmail.com"

# Empêcher l'installation d'ouvrir des dialogues de configuration
ENV DEBIAN_FRONTEND=noninteractive

# Mettre à jour le système et installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    software-properties-common

# Ajouter le repository pour PHP 8.1
RUN add-apt-repository ppa:ondrej/php && apt-get update

RUN apt-get update && apt-get install -y \
    nginx \
    mysql-server \
    php-fpm \
    php-mysql \
    php-pdo \
    php-pdo-mysql \
    php-cli \
    php-zip \
    php-gd \
    php-mbstring \
    php-curl \
    php-xml \
    php-pear \
    php-bcmath \
    unzip \
    curl \
    git \
    nano \
    && apt-get clean

# Copier le fichier de configuration Nginx
COPY ./nginx.conf /etc/nginx/sites-available/default

# Copier le projet dans le conteneur
COPY . /var/www/html

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier le fichier d'initialisation de la base de données
COPY ./sql /docker-entrypoint-initdb.d

# Copier le script de démarrage
COPY start_services.sh /start_services.sh

# Assurer les permissions du script
RUN chmod +x /start_services.sh

# Exposer les ports nécessaires
EXPOSE 8222 3306

# Commande pour démarrer les services
CMD ["/start_services.sh"]