# ============================================================================
# Ambiente Completo PHP 8.2 + MySQL (MariaDB) + phpMyAdmin - GitHub Codespaces
# Substituto moderno em nuvem ao XAMPP local (Infraestrutura como Código)
# ============================================================================

# 1. Imagem base leve do Linux Debian (Bullseye Slim)
FROM debian:bullseye-slim

# Evita que o instalador do Linux trave pedindo confirmação na tela durante o build
ARG DEBIAN_FRONTEND=noninteractive
USER root

# Copia nossas configurações customizadas do PHP e o script de inicialização
# O comando sed remove quebras de linha do Windows (CRLF -> LF) para evitar erros no Linux
COPY php.ini /tmp/php.ini
COPY start-services.sh /usr/local/bin/start-services.sh
RUN sed -i 's/\r$//' /tmp/php.ini /usr/local/bin/start-services.sh \
    && chmod +x /usr/local/bin/start-services.sh

# 2. Atualiza a lista de pacotes e instala o curl + certificados SSL
RUN apt-get update -yq \
    && apt-get install curl ca-certificates gnupg -yq

# 3. Adiciona o repositório oficial Sury (mantenedor oficial do PHP para Debian)
RUN curl -sSL https://packages.sury.org/php/README.txt | bash -x \
    && apt-get update -yq

# 4. Instala utilitários essenciais e o Servidor de Banco de Dados (MariaDB / MySQL)
RUN apt-get install git imagemagick nano openssh-server sqlite3 mariadb-server mariadb-client wget unzip -yq \
    && sed -i 's/<policy domain="coder" rights="none" pattern="PDF" \/>/<policy domain="coder" rights="read|write" pattern="PDF" \/>/g' /etc/ImageMagick-6/policy.xml

# 5. Instala o PHP 8.2 com drivers MySQL (PDO e MySQLi) e extensões essenciais
# - php8.2-mysql: instala os drivers nativos mysqlnd, pdo_mysql e mysqli
# - php8.2-xml e php8.2-mbstring: exigidos pelo phpMyAdmin e suporte UTF-8
RUN apt-get install php8.2-dev -yq \
    && apt-get install php8.2-mysql php8.2-xml php8.2-apcu php8.2-curl php8.2-gd php8.2-imagick php8.2-mbstring php8.2-sqlite3 php8.2-zip php8.2-intl -yq

# 6. Configura o PEAR/PECL, instala o Xdebug e aplica o nosso php.ini didático
# Removemos os .ini duplicados do conf.d para que o php.ini seja a única fonte de verdade sem gerar avisos
RUN pear config-set php_ini /etc/php/8.2/cli/php.ini \
    && pecl install xdebug \
    && rm -f /etc/php/8.2/cli/conf.d/*-mysqlnd.ini \
             /etc/php/8.2/cli/conf.d/*-pdo.ini \
             /etc/php/8.2/cli/conf.d/*-pdo_mysql.ini \
             /etc/php/8.2/cli/conf.d/*-mysqli.ini \
             /etc/php/8.2/cli/conf.d/*-sqlite3.ini \
             /etc/php/8.2/cli/conf.d/*-mbstring.ini \
             /etc/php/8.2/cli/conf.d/*-curl.ini \
             /etc/php/8.2/cli/conf.d/*-gd.ini \
             /etc/php/8.2/cli/conf.d/*-zip.ini \
             /etc/php/8.2/cli/conf.d/*-intl.ini \
    && cat /tmp/php.ini >> /etc/php/8.2/cli/php.ini

# 7. Configura o Banco de Dados MySQL/MariaDB inicial
# Cria o usuário 'root' com senha 'root' (acessível via localhost e 127.0.0.1) e o banco 'aula_php'
RUN service mariadb start \
    && mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('root');" \
    && mysql -uroot -proot -e "CREATE USER IF NOT EXISTS 'root'@'127.0.0.1' IDENTIFIED BY 'root';" \
    && mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;" \
    && mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS aula_php DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" \
    && mysql -uroot -proot -e "FLUSH PRIVILEGES;"

# 8. Instala e configura o phpMyAdmin 5.2 (Gerenciador visual do banco de dados)
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

# 9. Instala Node.js LTS
RUN curl -sL https://deb.nodesource.com/setup_lts.x | bash \
    && apt-get install nodejs -yq

# 10. Instala o Composer (gerenciador de dependências padrão do PHP)
RUN wget https://getcomposer.org/installer \
    && php installer --install-dir=/usr/local/bin --filename=composer \
    && rm installer
