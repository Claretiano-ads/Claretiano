# ============================================================================
# Ambiente Completo PHP 8.2 + MySQL (MariaDB) + phpMyAdmin - GitHub Codespaces
# Baseado em Debian 12 (Bookworm) onde o PHP 8.2 é nativo e 100% estável
# ============================================================================

# 1. Imagem base Debian 12 (Bookworm Slim) - Possui PHP 8.2 nativo sem depender de repositórios externos quebrados
FROM debian:bookworm-slim

ARG DEBIAN_FRONTEND=noninteractive
USER root

# 2. Atualiza pacotes básicos e instala utilitários essenciais + Banco MariaDB (MySQL)
RUN apt-get update -yq \
    && apt-get install -yq \
        curl \
        ca-certificates \
        git \
        nano \
        unzip \
        wget \
        procps \
        sqlite3 \
        mariadb-server \
        mariadb-client

# 3. Instala o PHP 8.2 nativo do Debian 12 com todos os drivers (PDO MySQL, MySQLi, Xdebug, etc.) e Composer
RUN apt-get install -yq \
        php8.2-cli \
        php8.2-common \
        php8.2-mysql \
        php8.2-xml \
        php8.2-mbstring \
        php8.2-curl \
        php8.2-gd \
        php8.2-zip \
        php8.2-intl \
        php8.2-sqlite3 \
        php8.2-apcu \
        php8.2-xdebug \
        composer \
        nodejs \
        npm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 4. Copia o nosso php.ini didático e o script de inicialização (convertendo quebras de linha Windows -> Linux)
COPY php.ini /tmp/php.ini
COPY start-services.sh /usr/local/bin/start-services.sh
RUN sed -i 's/\r$//' /tmp/php.ini /usr/local/bin/start-services.sh \
    && chmod +x /usr/local/bin/start-services.sh

# 5. Aplica o php.ini removendo atalhos duplicados do conf.d para evitar avisos de módulo já carregado
RUN rm -f /etc/php/8.2/cli/conf.d/*-mysqlnd.ini \
          /etc/php/8.2/cli/conf.d/*-pdo.ini \
          /etc/php/8.2/cli/conf.d/*-pdo_mysql.ini \
          /etc/php/8.2/cli/conf.d/*-mysqli.ini \
          /etc/php/8.2/cli/conf.d/*-sqlite3.ini \
          /etc/php/8.2/cli/conf.d/*-mbstring.ini \
          /etc/php/8.2/cli/conf.d/*-curl.ini \
          /etc/php/8.2/cli/conf.d/*-gd.ini \
          /etc/php/8.2/cli/conf.d/*-zip.ini \
          /etc/php/8.2/cli/conf.d/*-intl.ini \
          /etc/php/8.2/cli/conf.d/*-xdebug.ini \
    && cat /tmp/php.ini >> /etc/php/8.2/cli/php.ini

# 6. Pré-configura o banco de dados MariaDB (usuário root / senha root e banco aula_php)
RUN service mariadb start \
    && mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('root');" \
    && mysql -uroot -proot -e "CREATE USER IF NOT EXISTS 'root'@'127.0.0.1' IDENTIFIED BY 'root';" \
    && mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;" \
    && mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS aula_php DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" \
    && mysql -uroot -proot -e "FLUSH PRIVILEGES;"

# 7. Instala e configura o phpMyAdmin 5.2.1 (Gerenciador visual na porta 8080)
RUN wget -q https://files.phpmyadmin.net/phpMyAdmin/5.2.1/phpMyAdmin-5.2.1-all-languages.zip -O /tmp/phpmyadmin.zip \
    && unzip -q /tmp/phpmyadmin.zip -d /usr/share/ \
    && mv /usr/share/phpMyAdmin-5.2.1-all-languages /usr/share/phpmyadmin \
    && rm /tmp/phpmyadmin.zip \
    && printf "<?php\n\
\$cfg['blowfish_secret'] = 'ClaretianoADS2026ChaveSecreta32B';\n\
\$i = 1;\n\
\$cfg['Servers'][\$i]['auth_type'] = 'cookie';\n\
\$cfg['Servers'][\$i]['host'] = '127.0.0.1';\n\
\$cfg['Servers'][\$i]['compress'] = false;\n\
\$cfg['Servers'][\$i]['AllowNoPassword'] = true;\n\
\$cfg['TempDir'] = '/tmp';\n\
\$cfg['DefaultLang'] = 'pt_BR';\n" > /usr/share/phpmyadmin/config.inc.php
