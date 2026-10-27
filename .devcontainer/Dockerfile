# ============================================================================
# Ambiente Oficial GitHub Codespaces para PHP 8.2 + MySQL + phpMyAdmin
# Baseado na documentação oficial do GitHub Codespaces:
# https://docs.github.com/pt/codespaces/setting-up-your-project-for-codespaces/adding-a-dev-container-configuration/setting-up-your-php-project-for-codespaces
# ============================================================================

# 1. Imagem Oficial da Microsoft/GitHub para PHP 8.2 no Codespaces
FROM mcr.microsoft.com/devcontainers/php:1-8.2-bookworm

# 2. Compila e instala os drivers oficiais do MySQL (mysqli e pdo_mysql) para o PHP
# (O módulo base 'pdo' já vem compilado de fábrica na imagem oficial)
RUN docker-php-ext-install mysqli pdo_mysql \
    && rm -f /usr/local/etc/php/conf.d/docker-php-ext-mysqli.ini \
             /usr/local/etc/php/conf.d/docker-php-ext-pdo_mysql.ini

# 3. Remove o repositório legado do Yarn (cuja chave GPG expirou na imagem base da Microsoft)
# e instala o servidor de Banco de Dados MariaDB (MySQL)
RUN rm -f /etc/apt/sources.list.d/yarn.list \
    && apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get -y install --no-install-recommends mariadb-server mariadb-client unzip wget procps \
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# 4. Copia o nosso php.ini didático e o script de inicialização (convertendo CRLF -> LF)
COPY php.ini /usr/local/etc/php/conf.d/99-claretiano-php.ini
COPY start-services.sh /usr/local/bin/start-services.sh
RUN sed -i 's/\r$//' /usr/local/etc/php/conf.d/99-claretiano-php.ini /usr/local/bin/start-services.sh \
    && chmod +x /usr/local/bin/start-services.sh

# 5. Pré-configura o banco de dados MariaDB (usuário root / senha root e banco aula_php)
RUN service mariadb start \
    && mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('root');" \
    && mysql -uroot -proot -e "CREATE USER IF NOT EXISTS 'root'@'127.0.0.1' IDENTIFIED BY 'root';" \
    && mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;" \
    && mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS aula_php DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" \
    && mysql -uroot -proot -e "FLUSH PRIVILEGES;"

# 6. Instala e configura o phpMyAdmin 5.2.1 (Gerenciador visual na porta 8080)
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
