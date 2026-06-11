<?php
$stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome ASC");
$produtos = $stmt->fetchAll();
?>

<h1>Catálogo de Produtos</h1>
<div style='margin-bottom: 20px;'>
    <a href='index.php?classe=produtos&acao=cadastro' class="btn-link">+ Adicionar Produto</a>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 80px; text-align: center;">Imagem</th>
            <th>Produto</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if(empty($produtos)): ?>
        <tr><td colspan="6">Nenhum produto em estoque.</td></tr>
    <?php endif; ?>
    <?php foreach($produtos as $p): ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;">
                <?php if(!empty($p['imagem']) && file_exists('uploads/' . $p['imagem'])): ?>
                    <img src="uploads/<?= $p['imagem'] ?>" width="50" height="50" style="object-fit: cover; border-radius: 6px; border: 1px solid var(--borda);">
                <?php else: ?>
                    <span style="font-size: 0.75rem; color: var(--texto-secundario); font-style: italic;">Sem Foto</span>
                <?php endif; ?>
            </td>
            <td><strong><?= htmlspecialchars($p['nome']) ?></strong></td>
            <td><?= htmlspecialchars($p['descricao']) ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td><?= (int)$p['estoque'] ?> unidades</td>
            <td>
                <a href="index.php?classe=produtos&acao=editar&id=<?= $p['id'] ?>" style="color: #4e73df; font-weight: bold; text-decoration: none; margin-right: 10px;">Editar</a>
                <a href="index.php?classe=produtos&acao=excluir&id=<?= $p['id'] ?>" style="color: #e74a3b; font-weight: bold; text-decoration: none;">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>