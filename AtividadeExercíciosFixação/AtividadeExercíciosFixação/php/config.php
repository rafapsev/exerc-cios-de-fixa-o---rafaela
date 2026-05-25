<?php
// config.php — Configuração e inicialização da camada de persistência

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'agenda');

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    
    // Configurações do construtor do PDO exigidas pelo material didático
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die('Falha crítica na conexão de dados: ' . $e->getMessage());
}

/**
 * RESPOSTA TAREFA 11:
 * PDO::ERRMODE_EXCEPTION dispara um objeto PDOException capturável em estruturas try/catch, 
 * interrompendo o script quando queries falham. É recomendado para desenvolvimento e auditoria.
 * PDO::ERRMODE_SILENT apenas altera códigos internos de erro ocultando falhas da tela, 
 * exigindo validação manual via errorCode() a cada comando executado.
 */
?>