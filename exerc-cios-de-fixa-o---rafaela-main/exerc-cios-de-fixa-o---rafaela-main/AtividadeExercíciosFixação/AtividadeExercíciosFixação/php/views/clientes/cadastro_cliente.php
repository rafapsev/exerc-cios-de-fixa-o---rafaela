<?php
$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $cpf      = trim($_POST['cpf'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    $cpfNumeros = preg_replace('/[^0-9]/', '', $cpf);

    if (empty($nome) || empty($cpf) || empty($email) || empty($endereco)) {
        $mensagemErro = "Aviso: Nome, CPF, E-mail e Endereço são obrigatórios.";
    } elseif (strlen($cpfNumeros) !== 11) {
        $mensagemErro = "Erro: O CPF digitado deve conter exatamente 11 números (com ou sem pontos/traço).";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $cpf, $email, $telefone, $endereco]);
            echo "<script>window.location.href='index.php?classe=clientes';</script>";
            exit;
        } catch (PDOException $e) {
            $mensagemErro = "Erro: Esse CPF já está cadastrado no sistema.";
        }
    }
}
?>

<h2>Cadastrar Cliente</h2>
<?php if (!empty($mensagemErro)): ?><p style="color:red; font-weight:bold;"><?= $mensagemErro ?></p><?php endif; ?>

<form action="" method="POST" style="max-width: 450px; padding: 20px; border-radius: 6px; border: 1px solid var(--borda);">
    <label style="display:block; margin-top:10px; font-weight:bold;">Nome Completo *</label>
    <input type="text" name="nome" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">CPF *</label>
    <input type="text" name="cpf" placeholder="000.000.000-00" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">E-mail *</label>
    <input type="email" name="email" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Telefone</label>
    <input type="text" name="telefone">
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Endereço Completo *</label>
    <input type="text" name="endereco" required>
    
    <br><br>
    <button type="submit" class="btn-theme">Salvar Cliente</button>
    <a href="index.php?classe=clientes" style="margin-left:15px; color: var(--texto-secundario); text-decoration:none;">Voltar</a>
</form>