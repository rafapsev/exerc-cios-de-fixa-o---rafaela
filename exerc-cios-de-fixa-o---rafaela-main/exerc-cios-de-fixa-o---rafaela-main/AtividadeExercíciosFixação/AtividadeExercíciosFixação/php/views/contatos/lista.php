<h1 style="font-size: 1.6rem; margin-bottom: 20px;">Módulo de Contatos</h1>

<form method="GET" action="index.php" style="margin-bottom: 25px; display: flex; gap: 10px;">
    <input type="hidden" name="classe" value="contatos">
    <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Pesquisar por nome ou e-mail..." style="padding: 10px; width: 320px; border: 1px solid var(--borda); border-radius: 4px; background-color: inherit; color: inherit;">
    <button type="submit" class="btn-theme">Pesquisar</button>
    <?php if(!empty($busca)): ?>
        <a href="index.php?classe=contatos" style="padding: 10px 15px; background-color: #858796; color: white; text-decoration: none; border-radius: 4px; font-size: 0.9rem;">Limpar Filtros</a>
    <?php endif; ?>
</form>

<div style='margin-bottom: 20px;'>
    <a href='index.php?classe=contatos&acao=cadastro' class="btn-link">+ Adicionar Contato</a>
</div>

<?php exibirTabelaContatos($contatos); ?>

<div style="margin-top: 25px; display: flex; gap: 8px; align-items: center; font-size: 0.9rem;">
    <?php if ($pagina > 1): ?>
        <a href="index.php?classe=contatos&busca=<?= urlencode($busca) ?>&pagina=<?= $pagina - 1 ?>" style="padding: 6px 12px; border: 1px solid var(--borda); text-decoration: none; color: inherit; border-radius: 4px;">&laquo; Anterior</a>
    <?php endif; ?>

    <span style="font-weight: bold;">Página <?= $pagina ?> de <?= max(1, $totalPaginas) ?></span>

    <?php if ($pagina < $totalPaginas): ?>
        <a href="index.php?classe=contatos&busca=<?= urlencode($busca) ?>&pagina=<?= $pagina + 1 ?>" style="padding: 6px 12px; border: 1px solid var(--borda); text-decoration: none; color: inherit; border-radius: 4px;">Próximo &raquo;</a>
    <?php endif; ?>
</div>