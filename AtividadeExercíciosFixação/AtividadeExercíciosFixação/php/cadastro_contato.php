<?php
require_once "config.php";

$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if (empty($nome) || empty($email)) {
        $mensagemErro = "Aviso: Os campos Nome e E-mail são mandatórios!";
    } else {
        $stmt = $pdo->prepare('INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $email, $telefone]);
        header('Location: index.php');
        exit;
    }
}

include "cabecalho.php";
?>

<h2>Novo Contato</h2>
<?php if (!empty($mensagemErro)): ?><p class="erro-msg"><?= $mensagemErro ?></p><?php endif; ?>

<form action="" method="POST" style="max-width: 450px; background-color: #ffb3c1; padding: 20px; border-radius: 6px; border: 1px solid #e3e6f0;">
    <div style="margin-bottom: 12px;"> 
        <label style="display: block; margin-bottom: 4px; font-weight: bold;">Nome Completo *</label>
        <input type="text" name="nome" required style="width: 95%; padding: 8px; border: 1px solid #d1d3e2; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 12px;">
        <label style="display: block; margin-bottom: 4px; font-weight: bold;">Endereço de E-mail *</label>
        <input type="email" name="email" required style="width: 95%; padding: 8px; border: 1px solid #d1d3e2; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 4px; font-weight: bold;">Telefone / Celular</label>
        <input type="text" name="telefone" placeholder="(00) 00000-0000" style="width: 95%; padding: 8px; border: 1px solid #d1d3e2; border-radius: 4px;">
    </div>
    
    <button type="submit" style="padding: 10px 20px; background-color: #1cc88a; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Efetuar Cadastro</button>
    <a href="index.php" style="margin-left: 15px; color: #858796; text-decoration: none; font-size: 0.9rem;">Voltar ao painel</a>
</form>

<?php include "rodape.php"; ?>