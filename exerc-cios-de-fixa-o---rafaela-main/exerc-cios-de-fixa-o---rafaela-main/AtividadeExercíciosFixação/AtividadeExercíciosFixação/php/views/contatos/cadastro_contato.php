<?php
$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if (empty($nome) || empty($email)) {
        $mensagemErro = "Aviso: Os campos Nome e E-mail são obrigatórios!";
    } else {
        $stmt = $pdo->prepare('INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $email, $telefone]);
        echo "<script>window.location.href='index.php?classe=contatos';</script>";
        exit;
    }
}
?>

<h2>Novo Contato</h2>
<?php if (!empty($mensagemErro)): ?><p style="color:red; font-weight:bold;"><?= $mensagemErro ?></p><?php endif; ?>

<form action="" method="POST" style="max-width: 450px; padding: 20px; border-radius: 6px; border: 1px solid var(--borda);">
    <label style="display:block; margin-top:10px; font-weight:bold;">Nome *</label>
    <input type="text" name="nome" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">E-mail *</label>
    <input type="email" name="email" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Telefone</label>
    <input type="text" name="telefone">
    
    <br><br>
    <button type="submit" class="btn-theme">Efetuar Cadastro</button>
    <a href="index.php?classe=contatos" style="margin-left: 15px; color: var(--texto-secundario); text-decoration: none;">Voltar ao painel</a>
</form>