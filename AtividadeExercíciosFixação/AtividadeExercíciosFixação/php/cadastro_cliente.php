<?php
// cadastro_cliente.php
require_once "config.php";
include      "cabecalho.php";

$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $cpf      = trim($_POST['cpf'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    // Limpa pontos e traços para testar se há 11 números reais
    $cpfNumeros = preg_replace('/[^0-9]/', '', $cpf);

    if (empty($nome) || empty($cpf) || empty($email) || empty($endereco)) {
        $mensagemErro = "Aviso: Nome, CPF, E-mail e Endereço são obrigatórios.";
    } elseif (strlen($cpfNumeros) !== 11) {
        // Se não tiver exatamente 11 números, avisa o usuário sem sumir com a tela
        $mensagemErro = "Erro: O CPF digitado deve conter exatamente 11 números (com ou sem pontos/traço).";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $cpf, $email, $telefone, $endereco]);
            
            // Redireciona com sucesso para a listagem
            echo "<script>window.location.href='clientes.php';</script>";
            exit;
        } catch (PDOException $e) {
            $mensagemErro = "Erro: Esse CPF já está cadastrado no sistema.";
        }
    }
}
?>

<h2>Cadastrar Novo Cliente</h2>

<?php if (!empty($mensagemErro)): ?>
    <p style="color: red; font-weight: bold; margin-bottom: 15px;"><?= $mensagemErro ?></p>
<?php endif; ?>

<form action="" method="POST" style="max-width: 400px; background-color: #f8f9fa; padding: 20px; border-radius: 6px; border: 1px solid #e3e6f0;">
    <div style="margin-bottom: 10px;">
        <label style="display:block; margin-bottom:4px; font-weight:bold;">Nome do Cliente *</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label style="display:block; margin-bottom:4px; font-weight:bold;">CPF (11 dígitos) *</label>
        <input type="text" name="cpf" value="<?= htmlspecialchars($_POST['cpf'] ?? '') ?>" placeholder="000.000.000-00" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label style="display:block; margin-bottom:4px; font-weight:bold;">E-mail *</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label style="display:block; margin-bottom:4px; font-weight:bold;">Telefone</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="display:block; margin-bottom:4px; font-weight:bold;">Endereço Residencial *</label>
        <input type="text" name="endereco" value="<?= htmlspecialchars($_POST['endereco'] ?? '') ?>" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
    </div>
    
    <button type="submit" style="padding: 10px 20px; background-color: #1cc88a; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Cadastrar Cliente</button>
    <a href="clientes.php" style="margin-left: 15px; color: #333; text-decoration: none;">Voltar</a>
</form>

<?php include "rodape.php"; ?>