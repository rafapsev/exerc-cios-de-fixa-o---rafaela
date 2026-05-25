<?php
require_once "config.php";
include      "cabecalho.php";
include_once "funcoes.php";

$busca  = $_GET['busca'] ?? '';
$pagina = max(1, (int)($_GET['pagina'] ?? 1));
$porPagina = 5; // Limitação estrita de registros por lote de visualização

$contatos      = obterContatos($pdo, $busca, $pagina, $porPagina);
$totalContatos = contarContatos($pdo, $busca);
$totalPaginas  = ceil($totalContatos / $porPagina);
?>

<h1 style="font-size: 1.6rem; margin-bottom: 20px;">Módulo de Contatos</h1>

<form method="GET" action="" style="margin-bottom: 25px; display: flex; gap: 10px;">
    <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Pesquisar por nome ou e-mail..." style="padding: 10px; width: 320px; border: 1px solid #d1d3e2; border-radius: 4px; background-color: inherit; color: inherit;">
    <button type="submit" class="btn-theme">Pesquisar</button>
    <?php if(!empty($busca)): ?>
        <a href="index.php" style="padding: 10px 15px; background-color: #858796; color: white; text-decoration: none; border-radius: 4px; font-size: 0.9rem;">Limpar Filtros</a>
    <?php endif; ?>
</form>

<div style='margin-bottom: 20px;'>
    <a href='cadastro_contato.php' style="padding: 10px 18px; background-color: #1cc88a; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 0.9rem;">+ Adicionar Contato</a>
</div>

<?php exibirTabelaContatos($contatos); ?>

<div style="margin-top: 25px; display: flex; gap: 8px; align-items: center; font-size: 0.9rem;">
    <?php if ($pagina > 1): ?>
        <a href="?busca=<?= urlencode($busca) ?>&pagina=<?= $pagina - 1 ?>" style="padding: 6px 12px; border: 1px solid #d1d3e2; text-decoration: none; color: inherit; border-radius: 4px;">&laquo; Anterior</a>
    <?php endif; ?>

    <span style="font-weight: bold;">Página <?= $pagina ?> de <?= max(1, $totalPaginas) ?></span>

    <?php if ($pagina < $totalPaginas): ?>
        <a href="?busca=<?= urlencode($busca) ?>&pagina=<?= $pagina + 1 ?>" style="padding: 6px 12px; border: 1px solid #d1d3e2; text-decoration: none; color: inherit; border-radius: 4px;">Próximo &raquo;</a>
    <?php endif; ?>
</div>

<?php include "rodape.php"; ?>