<?php
// funcoes.php — Camada de persistência/lógica e renderização de Contatos

function obterContatos(PDO $pdo, string $busca = '', int $pagina = 1, int $porPagina = 5): array {
    $offset = ($pagina - 1) * $porPagina;
    $termo  = '%' . $busca . '%';

    // SQL Dinâmico preparado para receber parâmetros de paginação e busca controlada por índices
    $sql = "SELECT id, nome, email, telefone FROM contatos 
            WHERE nome LIKE ? OR email LIKE ? 
            ORDER BY nome ASC 
            LIMIT ? OFFSET ?";
            
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $termo, PDO::PARAM_STR);
    $stmt->bindValue(2, $termo, PDO::PARAM_STR);
    $stmt->bindValue(3, $porPagina, PDO::PARAM_INT);
    $stmt->bindValue(4, $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll();
}

function contarContatos(PDO $pdo, string $busca = ''): int {
    $termo = '%' . $busca . '%';
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM contatos WHERE nome LIKE ? OR email LIKE ?");
    $stmt->execute([$termo, $termo]);
    return (int)$stmt->fetchColumn();
}

function exibirTabelaContatos(array $contatos): void {
    if (empty($contatos)) {
        echo "<p>Nenhum contato localizado para os termos informados.</p>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    // Exercício 5 (Tarefa 22): Correção estrita — Botões divididos em duas colunas independentes
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Editar</th><th>Excluir</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($contatos as $indice => $contato) {
        $num   = $indice + 1;
        $id    = $contato['id'];
        $nome  = htmlspecialchars($contato['nome']);
        $email = htmlspecialchars($contato['email']);
        $fone  = htmlspecialchars($contato['telefone']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        // Envio de parâmetros por Query String estruturada
        echo "      <td><a href='editar_contato.php?id={$id}' style='color: #4e73df; font-weight: bold; text-decoration: none;'>Editar</a></td>\n";
        echo "      <td><a href='excluir_contato.php?id={$id}' style='color: #e74a3b; font-weight: bold; text-decoration: none;'>Excluir</a></td>\n";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}
?>