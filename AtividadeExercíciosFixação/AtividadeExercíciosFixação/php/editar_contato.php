<?php
require_once "config.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { 
    header('Location: index.php'); 
    exit; 
}

$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if (empty($nome) || empty($email)) {
        $mensagemErro = "Nome e E-mail não podem ser salvos em branco.";
    } else {
        $stmt = $pdo->prepare('UPDATE contatos SET nome = ?, email = ?, telefone = ? WHERE id = ?');
        $stmt->execute([$nome, $email, $telefone, $id]);
        header('Location: index.php');
        exit;
    }
}

$stmt = $pdo->prepare('SELECT * FROM contatos WHERE id = ?');
$stmt->execute([$id]);
$contato = $stmt->fetch();
if (!$contato) { 
    header('Location: index.php'); 
    exit; 
}

include "cabecalho.php";
?>

<h2>Modificar Registro de Contato</h2>
<?php if (!empty($mensagemErro)): ?><p class="erro-msg"><?= $mensagemErro ?></p><?php endif; ?>

<form action="" method="POST" style="max-width: 450px; background-color: #f8f9fa; padding: 20px; border-radius: 6px; border: 1px solid #e3e6f0;">
    <div style="margin-bottom: 12px;">
        <label style="display: block; margin-bottom: 4px; font-weight: bold;">Nome Completo</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($contato['nome']) ?>" required style="width: 95%; padding: 8px; border: 1px solid #d1d3e2; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 12px;">
        <label style="display: block; margin-bottom: 4px; font-weight: bold;">E-mail Corporativo</label>
        <input type="email" name="email" value="<?= htmlspecialchars($contato['email']) ?>" required style="width: 95%; padding: 8px; border: 1px solid #d1d3e2; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 4px; font-weight: bold;">Telefone</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($contato['telefone']) ?>" style="width: 95%; padding: 8px; border: 1px solid #d1d3e2; border-radius: 4px;">
    </div>
    
    <button type="submit" style="padding: 10px 20px; background-color: #4e73df; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Salvar Alterações</button>
    <a href="index.php" style="margin-left: 15px; color: #858796; text-decoration: none; font-size: 0.9rem;">Cancelar</a>
</form>

<?php include "rodape.php"; ?>