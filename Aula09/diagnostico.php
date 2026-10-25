<?php
/* ==========================================================================
   Aula 09 - Painel de Diagnóstico do Container (O "Dashboard do XAMPP" no Codespaces)
   Mostra ao aluno que o PHP está rodando no Servidor Linux e conectado ao MySQL
   ========================================================================== */

require_once __DIR__ . '/conexao.php';

// Consulta a versão exata do servidor MariaDB/MySQL rodando no container
$versaoBanco = $pdo->query("SELECT VERSION() AS versao")->fetch()['versao'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aula 09 - Diagnóstico do Ambiente (XAMPP vs Docker)</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>

    <div id="conteudo">
        <div class="barra-topo">
            <span><strong>Ambiente:</strong> GitHub Codespaces (Container Docker)</span>
            <a href="index.php">&larr; Voltar para o Sistema de Cadastro</a>
        </div>

        <h2>Raio-X do Servidor (XAMPP &rarr; Codespaces)</h2>
        <p class="subtitulo">
            No XAMPP tradicional, abríamos o painel de controle no Windows para checar o <strong>Apache</strong> e o <strong>MySQL</strong>.
            Aqui no GitHub Codespaces, tudo roda dentro de um container Linux configurado via código!
        </p>

        <table class="tabela-dados">
            <thead>
                <tr>
                    <th>Componente (Sigla XAMPP)</th>
                    <th>No XAMPP Tradicional</th>
                    <th>No Nosso Container Docker</th>
                    <th>Status Atual</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>X</strong> (Sistema Operacional)</td>
                    <td>Windows Local</td>
                    <td><code><?= php_uname('s') . ' (' . php_uname('m') . ')' ?></code></td>
                    <td><span class="badge badge-ok">Ativo</span></td>
                </tr>
                <tr>
                    <td><strong>A</strong> (Servidor Web / htdocs)</td>
                    <td><code>C:\xampp\htdocs\Aula09</code></td>
                    <td><code><?= htmlspecialchars($_SERVER['DOCUMENT_ROOT']) ?></code></td>
                    <td><span class="badge badge-ok">Porta 8000</span></td>
                </tr>
                <tr>
                    <td><strong>M</strong> (Banco MySQL / MariaDB)</td>
                    <td>MySQL Local (Porta 3306)</td>
                    <td><code><?= htmlspecialchars($versaoBanco) ?></code></td>
                    <td><span class="badge badge-ok">Conectado</span></td>
                </tr>
                <tr>
                    <td><strong>P</strong> (Linguagem PHP + php.ini)</td>
                    <td>PHP Local</td>
                    <td>PHP <code><?= PHP_VERSION ?></code></td>
                    <td><span class="badge badge-ok">Ativo</span></td>
                </tr>
                <tr>
                    <td><strong>Extensão PDO MySQL</strong></td>
                    <td>Habilitado no <code>php.ini</code></td>
                    <td><code>extension=pdo_mysql</code></td>
                    <td>
                        <?php if (extension_loaded('pdo_mysql')): ?>
                            <span class="badge badge-ok">Carregado</span>
                        <?php else: ?>
                            <span class="badge badge-erro">Ausente</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>phpMyAdmin</strong></td>
                    <td><code>localhost/phpmyadmin</code></td>
                    <td>Aba <strong>PORTS &rarr; Porta 8080</strong> (user: <code>root</code> / pass: <code>root</code>)</td>
                    <td><span class="badge badge-ok">Porta 8080</span></td>
                </tr>
            </tbody>
        </table>

        <h3>Hora Certa no Servidor (Configurada no <code>php.ini</code>)</h3>
        <p class="subtitulo">
            Fuso horário ativo: <code><?= date_default_timezone_get() ?></code> &mdash;
            Gerado pelo PHP em: <strong><?= date('d/m/Y H:i:s') ?></strong>
        </p>
    </div>

</body>
</html>

