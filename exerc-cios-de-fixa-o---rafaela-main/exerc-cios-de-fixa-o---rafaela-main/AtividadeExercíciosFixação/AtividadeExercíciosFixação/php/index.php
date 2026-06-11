<?php
// index.php — Roteador Central da Aplicação
require_once "config/config.php";
require_once "models/contatodao.php";
require_once "funcoes.php";

$classe = $_GET['classe'] ?? 'contatos';
$acao   = $_GET['acao'] ?? 'listar';

include "views/cabecalho.php";

switch ($classe) {
    case 'contatos':
        $contatoDAO = new contatoDAO($pdo);
        $busca  = $_GET['busca'] ?? '';
        $pagina = max(1, (int)($_GET['pagina'] ?? 1));
        $porPagina = 5;

        if ($acao === 'cadastro') {
            include "views/contatos/cadastro_contato.php";
        } elseif ($acao === 'editar') {
            include "views/contatos/editar_contato.php";
        } elseif ($acao === 'excluir') {
            include "views/contatos/excluir_contato.php";
        } else {
            $contatos      = $contatoDAO->obterContatos($busca, $pagina, $porPagina);
            $totalContatos = $contatoDAO->contarContatos($busca);
            $totalPaginas  = ceil($totalContatos / $porPagina);
            include "views/contatos/lista.php";
        }
        break;

    case 'clientes':
        if ($acao === 'cadastro') {
            include "views/clientes/cadastro_cliente.php";
        } elseif ($acao === 'editar') {
            include "views/clientes/editar_cliente.php";
        } elseif ($acao === 'excluir') {
            include "views/clientes/excluir_cliente.php";
        } else {
            include "views/clientes/clientes.php";
        }
        break;

    case 'produtos':
        if ($acao === 'cadastro') {
            include "views/produto/cadastro_produto.php";
        } elseif ($acao === 'editar') {
            include "views/produto/editar_produto.php";
        } elseif ($acao === 'excluir') {
            include "views/produto/excluir_produto.php";
        } else {
            include "views/produto/produtos.php";
        }
        break;
}

include "views/rodape.php";
?>