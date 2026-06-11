<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'agenda');

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die('Falha crítica na conexão de dados: ' . $e->getMessage());
}

/*
================================================================================
RESPOSTA DA TAREFA 11 — EXERCÍCIO 2:
--------------------------------------------------------------------------------
* PDO::ERRMODE_SILENT: 
  É o modo padrão do PDO. Se ocorrer um erro no banco, ele não mostra nada na tela 
  e não para a execução. O código continua rodando e obriga o programador a ficar 
  checando manualmente os erros usando PDO::errorCode() ou PDO::errorInfo().

* PDO::ERRMODE_EXCEPTION: 
  Faz o PDO disparar uma exceção (um objeto PDOException) assim que ocorre qualquer 
  erro de SQL. Isso interrompe o fluxo imediatamente se não estiver em um bloco 
  try/catch, permitindo capturar o erro exato de forma limpa e segura, ideal para 
  ambientes de desenvolvimento e produção.
================================================================================
*/
?>