-- ============================================================================
-- Aula 09 - Script SQL para Testes no phpMyAdmin (Porta 8080)
-- Banco de Dados: aula_php (Já criado automaticamente pelo Dockerfile)
-- ============================================================================

USE aula_php;

-- 1. Criação da tabela para o exemplo do Professor (Live Coding)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    curso VARCHAR(80) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserindo um registro inicial de exemplo
INSERT INTO usuarios (nome, email, curso)
VALUES ('Maria Oliveira', 'maria.oliveira@claretiano.edu.br', 'Análise e Desenvolvimento de Sistemas');

-- ============================================================================
-- 2. Criação da tabela para a Atividade Hands-On dos Alunos (Atividade 09)
-- ============================================================================
CREATE TABLE IF NOT EXISTS chamados_suporte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    solicitante VARCHAR(100) NOT NULL,
    setor VARCHAR(60) NOT NULL,
    prioridade VARCHAR(30) NOT NULL,
    descricao TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

