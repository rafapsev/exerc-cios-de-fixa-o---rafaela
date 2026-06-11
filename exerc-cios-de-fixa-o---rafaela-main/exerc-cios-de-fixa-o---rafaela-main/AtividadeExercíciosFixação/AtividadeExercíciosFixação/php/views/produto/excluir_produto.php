<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "<script>window.location.href='index.php?classe=produtos';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Executa a exclusão mecânica via Prepared Statement
    $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = ?');
    $stmt->execute([$id]);
    echo "<script>window.location.href='index.php?classe=produtos';</script>";
    exit;
}

// Busca os dados do produto para exibir na tela de confirmação
$stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
$stmt->execute([$id]);
$produto = $stmt->fetch();

if (!$produto) {
    echo "<script>window.location.href='index.php?classe=produtos';</script>";
    exit;
}
?>

<h2>Confirmar Exclusão de Produto</h2>
<div style="padding: 20px; border: 1px solid var(--borda); border-radius: 6px; max-width: 500px;">
    <p>Tem certeza que deseja remover o produto <strong><?= htmlspecialchars($produto['nome']) ?></strong> do catálogo?</p>
    <p style="color: red; font-size: 0.9rem;">Esta ação removerá o item permanentemente do estoque.</p>
    
    <form action="" method="POST">
        <button type="submit" class="btn-theme" style="background-color: #e74a3b; border-color: #e74a3b;">Sim, Remover</button>
        <a href="index.php?classe=produtos" style="margin-left: 15px; color: var(--texto-secundario); text-decoration: none;">Cancelar</a>
    </form>
</div>