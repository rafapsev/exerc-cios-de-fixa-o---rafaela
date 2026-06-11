<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "<script>window.location.href='index.php?classe=produtos';</script>";
    exit;
}

$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco     = (float)str_replace(',', '.', $_POST['preco'] ?? 0);
    $estoque   = (int)($_POST['estoque'] ?? 0);

    if ($preco <= 0 || $estoque < 0) {
        $mensagemErro = "Erro: O preço deve ser maior que zero e o estoque não pode ser negativo!";
    } elseif (empty($nome)) {
        $mensagemErro = "O campo Nome do Produto é obrigatório.";
    } else {
        $stmt = $pdo->prepare("SELECT imagem FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $nomeImagem = $stmt->fetchColumn() ?: null;

        if (!empty($_FILES['imagem']['name'])) {
            $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
            if (in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
                $nomeImagem = uniqid('prod_') . '.' . $extensao;
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeImagem);
            }
        }

        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ?, estoque = ?, imagem = ? WHERE id = ?");
        $stmt->execute([$nome, $descricao, $preco, $estoque, $nomeImagem, $id]);
        echo "<script>window.location.href='index.php?classe=produtos';</script>";
        exit;
    }
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch();

if (!$produto) {
    echo "<script>window.location.href='index.php?classe=produtos';</script>";
    exit;
}
?>

<h2>Editar Produto</h2>
<?php if (!empty($mensagemErro)): ?><p style="color:red; font-weight:bold;"><?= $mensagemErro ?></p><?php endif; ?>

<form action="" method="POST" enctype="multipart/form-data" style="max-width: 400px; padding: 20px; border-radius: 6px; border: 1px solid var(--borda);">
    <label style="display:block; margin-top:10px; font-weight:bold;">Nome do Produto *</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Descrição</label>
    <textarea name="descricao" style="height:60px;"><?= htmlspecialchars($produto['descricao']) ?></textarea>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Preço *</label>
    <input type="text" name="preco" value="<?= $produto['preco'] ?>" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Estoque *</label>
    <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" required>
    
    <label style="display:block; margin-top:15px; font-weight:bold;">Alterar Foto</label>
    <input type="file" name="imagem" style="border: none; padding: 5px 0;">
    
    <br><br>
    <button type="submit" class="btn-theme">Salvar Alterações</button>
    <a href="index.php?classe=produtos" style="margin-left:15px; color: var(--texto-secundario); text-decoration:none;">Voltar</a>
</form>