FROM php:7.2

ENV TIMEZONE Europe/Paris
ENV TERM xterm
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HTACCESS_PROTECT 0
ENV COMPOSER_NO_INTERACTION 1
ENV NVM_DIR /root/.nvm
ENV NODE_VERSION 8

COPY --from=composer:1.8 /usr/bin/composer /usr/bin/composer

SHELL ["/bin/bash", "-c"]

RUN apt-get update && \
    apt-get install -y apt-utils debconf-utils apt-transport-https && \
    apt-get install -y \
        build-essential \
        ${PHPIZE_DEPS} \
        libicu-dev \
        locales \
        zip \
        unzip \
        unixodbc \
        unixodbc-dev \
        unixodbc-bin \
        libodbc1 \
        odbcinst1debian2 \
        tdsodbc \
        freetds-bin \
        freetds-common \
        freetds-dev \
        libct4 \
        libsybdb5 \
        libxml2 \
        curl \
        libcurl3 \
        libedit2 \
        libicu57 \
        git \
        acl \
        curl \
        nano \
        openssh-client \
        bash \
        libmcrypt-dev \
        libxml2-dev \
        freetds-dev \
        gcc \
        zlib1g \
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        autoconf \
        supervisor && \
    pecl install apcu && \
    pecl install xdebug && \
    ln -s /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib && \
    docker-php-ext-install -j$(nproc) pdo_mysql && \
    docker-php-ext-install -j$(nproc) opcache && \
    docker-php-ext-install -j$(nproc) bcmath && \
    docker-php-ext-install -j$(nproc) intl && \
        docker-php-ext-enable apcu && \
        curl -sS https://get.symfony.com/cli/installer | bash && \
        mv ~/.symfony/bin/symfony /usr/bin/symfony && \
        symfony local:server:ca:install && \
        mkdir -p $NVM_DIR && \
        curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.34.0/install.sh | bash && \
        source "$NVM_DIR/nvm.sh" && \
        nvm install stable && nvm use stable && \
        curl -o- -L https://yarnpkg.com/install.sh | bash -s -- -- && \
        $HOME/.yarn/bin/yarn global add gulp && \
        cat /root/.bashrc && \
        echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && locale-gen && \
        apt-get clean

RUN echo "date.timezone=$TIMEZONE" >> /usr/local/etc/php/php.ini && \
    echo "max_execution_time = 60;" >> /usr/local/etc/php/php.ini && \
    echo "memory_limit = 512M;" >> /usr/local/etc/php/php.ini

WORKDIR /opt/srv

EXPOSE 80
EXPOSE 443

VOLUME /opt/srv

ENTRYPOINT []

CMD ["symfony", "server:start", "--allow-http"]
