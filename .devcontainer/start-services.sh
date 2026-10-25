#!/usr/bin/env bash
# ============================================================================
# Script de Inicialização Automática dos Serviços (MySQL + phpMyAdmin)
# Executado automaticamente pelo GitHub Codespaces (postStartCommand)
# ============================================================================

echo "🚀 Iniciando banco de dados MariaDB (MySQL)..."
sudo service mariadb start

# Garante que o usuário 'root' (senha 'root') e o banco 'aula_php' estejam prontos
sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('root');" 2>/dev/null || true
sudo mysql -uroot -proot -e "CREATE USER IF NOT EXISTS 'root'@'127.0.0.1' IDENTIFIED BY 'root';" 2>/dev/null || true
sudo mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;" 2>/dev/null || true
sudo mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS aula_php DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null || true
sudo mysql -uroot -proot -e "FLUSH PRIVILEGES;" 2>/dev/null || true

# Verifica se o phpMyAdmin já está rodando na porta 8080; se não, inicia em background
if ! pgrep -f "0.0.0.0:8080" > /dev/null; then
    echo "🌐 Iniciando phpMyAdmin na porta 8080..."
    nohup php -S 0.0.0.0:8080 -t /usr/share/phpmyadmin > /tmp/phpmyadmin.log 2>&1 &
fi

echo "✅ Ambiente pronto!"
echo "   - PHP instalado: $(php -v | head -n 1)"
echo "   - Banco MySQL/MariaDB ativo na porta 3306 (Usuário: root | Senha: root | DB: aula_php)"
echo "   - phpMyAdmin ativo na porta 8080"
echo "   - Para rodar a Aula 09 na porta 8000: php -S 0.0.0.0:8000 -t Aula09"
