<?php
require_once "config.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { 
    header('Location: index.php'); 
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('DELETE FROM contatos WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT nome FROM contatos WHERE id = ?');
$stmt->execute([$id]);
$contato = $stmt->fetch();
if (!$contato) { 
    header('Location: index.php'); 
    exit; 
}

// O cabeçalho visual só entra aqui, depois de todas as checagens e do POST
include "cabecalho.php";
?>

<h2>Garantia de Exclusão</h2>
<div style="background-color: #fdf3f2; color: #b7271a; padding: 20px; border: 1px solid #f5c6cb; border-radius: 6px; max-width: 550px;">
    <p style="font-size: 1.1rem; margin-top: 0;">Você confirma a remoção definitiva de <strong><?= htmlspecialchars($contato['nome']) ?></strong>?</p>
    <p style="font-size: 0.9rem;">Esta ação limpará o registro e as estatísticas do contato associadas a ele imediatamente do servidor.</p>
    
    <form action="" method="POST" style="margin-top: 20px;">
        <button type="submit" style="padding: 10px 18px; background-color: #e74a3b; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Confirmar e Apagar</button>
        <a href="index.php" style="margin-left: 15px; color: #5a5c69; text-decoration: none; font-size: 0.95rem;">Desistir e Voltar</a>
    </form>
</div>

<?php include "rodape.php"; ?>