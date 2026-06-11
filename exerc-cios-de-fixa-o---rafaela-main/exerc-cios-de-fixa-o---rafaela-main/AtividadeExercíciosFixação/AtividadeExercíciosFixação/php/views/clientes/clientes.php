<?php
$stmt = $pdo->query("SELECT * FROM clientes ORDER BY nome ASC");
$clientes = $stmt->fetchAll();
?>

<h1>Módulo de Clientes</h1>
<div style='margin-bottom: 20px;'>
    <a href='index.php?classe=clientes&acao=cadastro' class="btn-link">+ Adicionar Cliente</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if(empty($clientes)): ?>
        <tr><td colspan="6">Nenhum cliente registrado.</td></tr>
    <?php endif; ?>
    <?php foreach($clientes as $c): ?>
        <tr>
            <td><strong><?= htmlspecialchars($c['nome']) ?></strong></td>
            <td><?= htmlspecialchars($c['cpf']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['telefone']) ?></td>
            <td><?= htmlspecialchars($c['endereco']) ?></td>
            <td>
                <a href="index.php?classe=clientes&acao=editar&id=<?= $c['id'] ?>" style="color: #4e73df; font-weight: bold; text-decoration: none; margin-right: 10px;">Editar</a>
                <a href="index.php?classe=clientes&acao=excluir&id=<?= $c['id'] ?>" style="color: #e74a3b; font-weight: bold; text-decoration: none;">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>