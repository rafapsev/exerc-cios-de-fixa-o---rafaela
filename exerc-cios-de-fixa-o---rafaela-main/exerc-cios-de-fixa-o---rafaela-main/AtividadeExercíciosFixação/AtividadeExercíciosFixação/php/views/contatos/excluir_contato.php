<?php
if (!isset($contatoDAO)) {
    $contatoDAO = new contatoDAO($pdo);
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "<script>window.location.href='index.php?classe=contatos';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Correção mecânica: Utilizando a camada Model (DAO)
    $contatoDAO->excluir($id);
    echo "<script>window.location.href='index.php?classe=contatos';</script>";
    exit;
}

// Correção mecânica: Utilizando a camada Model (DAO)
$contato = $contatoDAO->obterPorId($id);

if (!$contato) {
    echo "<script>window.location.href='index.php?classe=contatos';</script>";
    exit;
}
?>

<h2>Confirmar Exclusão</h2>
<div style="padding: 20px; border: 1px solid var(--borda); border-radius: 6px; max-width: 500px;">
    <p>Tem certeza que deseja apagar o contato <strong><?= htmlspecialchars($contato['nome']) ?></strong>?</p>
    <p style="color: red; font-size: 0.9rem;">Esta ação não pode ser desfeita.</p>
    
    <form action="" method="POST">
        <button type="submit" class="btn-theme" style="background-color: #e74a3b; border-color: #e74a3b;">Sim, Excluir</button>
        <a href="index.php?classe=contatos" style="margin-left: 15px; color: var(--texto-secundario); text-decoration: none;">Cancelar</a>
    </form>
</div>