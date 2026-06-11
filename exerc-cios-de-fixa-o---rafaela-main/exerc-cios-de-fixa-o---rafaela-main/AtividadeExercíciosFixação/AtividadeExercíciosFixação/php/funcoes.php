<?php
// funcoes.php — Camada de renderização de Contatos

function exibirTabelaContatos(array $contatos): void {
    if (empty($contatos)) {
        echo "<p>Nenhum contato localizado para os termos informados.</p>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>\n";
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
        echo "      <td>\n";
        echo "        <a href='index.php?classe=contatos&acao=editar&id={$id}' style='color: #4e73df; font-weight: bold; text-decoration: none; margin-right: 10px;'>Editar</a>\n";
        echo "        <a href='index.php?classe=contatos&acao=excluir&id={$id}' style='color: #e74a3b; font-weight: bold; text-decoration: none;'>Excluir</a>\n";
        echo "      </td>\n";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}
?>