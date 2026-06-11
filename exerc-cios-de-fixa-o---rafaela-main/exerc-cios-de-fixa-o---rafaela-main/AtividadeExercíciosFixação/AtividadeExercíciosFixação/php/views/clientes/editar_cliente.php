<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "<script>window.location.href='index.php?classe=clientes';</script>";
    exit;
}

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
        $mensagemErro = "Erro: O CPF digitado deve conter exatamente 11 números.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, cpf = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?");
            $stmt->execute([$nome, $cpf, $email, $telefone, $endereco, $id]);
            echo "<script>window.location.href='index.php?classe=clientes';</script>";
            exit;
        } catch (PDOException $e) {
            $mensagemErro = "Erro: Esse CPF já está cadastrado no sistema.";
        }
    }
}

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch();

if (!$cliente) {
    echo "<script>window.location.href='index.php?classe=clientes';</script>";
    exit;
}
?>

<h2>Modificar Registro de Cliente</h2>
<?php if (!empty($mensagemErro)): ?><p style="color:red; font-weight:bold;"><?= $mensagemErro ?></p><?php endif; ?>

<form action="" method="POST" style="max-width: 450px; padding: 20px; border-radius: 6px; border: 1px solid var(--borda);">
    <label style="display:block; margin-top:10px; font-weight:bold;">Nome Completo *</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">CPF *</label>
    <input type="text" name="cpf" value="<?= htmlspecialchars($cliente['cpf']) ?>" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">E-mail *</label>
    <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Telefone</label>
    <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>">
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Endereço Completo *</label>
    <input type="text" name="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" required>
    
    <br><br>
    <button type="submit" class="btn-theme">Salvar Alterações</button>
    <a href="index.php?classe=clientes" style="margin-left:15px; color: var(--texto-secundario); text-decoration:none;">Cancelar</a>
</form>