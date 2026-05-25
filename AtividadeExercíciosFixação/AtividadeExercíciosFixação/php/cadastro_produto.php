<?php
// cadastro_produto.php
require_once "config.php";
include      "cabecalho.php";

$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco     = (float)str_replace(',', '.', $_POST['preco'] ?? 0);
    $estoque   = (int)($_POST['estoque'] ?? 0);
    $nomeImagem = null;

    if ($preco <= 0 || $estoque < 0) {
        $mensagemErro = "Erro: O preço deve ser maior que zero e o estoque não pode ser negativo!";
    } elseif (empty($nome)) {
        $mensagemErro = "O campo Nome do Produto é obrigatório.";
    } else {
        // Processamento do Upload da Imagem obrigatória/opcional do exercício
        if (!empty($_FILES['imagem']['name'])) {
            $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
            
            // Valida extensões seguras de imagem
            if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
                $mensagemErro = "Formato de arquivo inválido. Use apenas JPG, JPEG, PNG ou WEBP.";
            } else {
                // Cria um nome único criptografado para o arquivo para evitar duplicados
                $nomeImagem = uniqid('prod_') . '.' . $extensao;
                
                // Cria a pasta uploads automaticamente caso ela não exista no seu computador
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                
                // Move o arquivo temporário para a pasta final
                move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeImagem);
            }
        }

        if (empty($mensagemErro)) {
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco, estoque, imagem) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $descricao, $preco, $estoque, $nomeImagem]);
            echo "<script>window.location.href='produtos.php';</script>";
            exit;
        }
    }
}
?>

<h2>Cadastrar Produto</h2>
<?php if (!empty($mensagemErro)): ?><p style="color:red; font-weight:bold;"><?= $mensagemErro ?></p><?php endif; ?>

<form action="" method="POST" enctype="multipart/form-data" style="max-width: 400px;">
    <label style="display:block; margin-top:10px; font-weight:bold;">Nome do Produto *</label>
    <input type="text" name="nome" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Descrição</label>
    <textarea name="descricao" style="height:60px;"></textarea>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Preço *</label>
    <input type="text" name="preco" placeholder="0.00" required>
    
    <label style="display:block; margin-top:10px; font-weight:bold;">Estoque Inicial *</label>
    <input type="number" name="estoque" required>
    
    <label style="display:block; margin-top:15px; font-weight:bold;">Foto do Produto</label>
    <input type="file" name="imagem" style="border: none; padding: 5px 0;">
    
    <br><br>
    <button type="submit" class="btn-theme">Salvar Produto</button>
    <a href="produtos.php" style="margin-left:15px; color: var(--texto-secundario); text-decoration:none;">Voltar</a>
</form>

<?php include "rodape.php"; ?>