<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "<script>window.location.href='index.php?classe=clientes';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('DELETE FROM clientes WHERE id = ?');
    $stmt->execute([$id]);
    echo "<script>window.location.href='index.php?classe=clientes';</script>";
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM clientes WHERE id = ?');
$stmt->execute([$id]);
$cliente = $stmt->fetch();

if (!$cliente) {
    echo "<script>window.location.href='index.php?classe=clientes';</script>";
    exit;
}
?>

<h2>Confirmar Exclusão de Cliente</h2>
<div style="padding: 20px; border: 1px solid var(--borda); border-radius: 6px; max-width: 500px;">
    <p>Tem certeza que deseja apagar o registro do cliente <strong><?= htmlspecialchars($cliente['nome']) ?></strong>?</p>
    <p style="color: red; font-size: 0.9rem;">Esta ação não poderá ser desfeita.</p>
    
    <form action="" method="POST">
        <button type="submit" class="btn-theme" style="background-color: #e74a3b; border-color: #e74a3b;">Sim, Excluir</button>
        <a href="index.php?classe=clientes" style="margin-left: 15px; color: var(--texto-secundario); text-decoration: none;">Cancelar</a>
    </form>
</div>