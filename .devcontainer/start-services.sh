#!/usr/bin/env bash
# ============================================================================
# Script de Inicialização Automática dos Serviços (MySQL + phpMyAdmin)
# Executado automaticamente pelo GitHub Codespaces (postStartCommand)
# ============================================================================

echo "🚀 Iniciando banco de dados MariaDB (MySQL)..."
service mariadb start

# Verifica se o phpMyAdmin já está rodando na porta 8080; se não, inicia em background
if ! pgrep -f "0.0.0.0:8080" > /dev/null; then
    echo "🌐 Iniciando phpMyAdmin na porta 8080..."
    nohup php -S 0.0.0.0:8080 -t /usr/share/phpmyadmin > /tmp/phpmyadmin.log 2>&1 &
fi

echo "✅ Ambiente pronto!"
echo "   - Banco MySQL/MariaDB ativo na porta 3306 (Usuário: root | Senha: root | DB padrão: aula_php)"
echo "   - phpMyAdmin ativo na porta 8080"
echo "   - Para rodar sua aula de PHP na porta 8000, use: php -S 0.0.0.0:8000 -t Aula09"

