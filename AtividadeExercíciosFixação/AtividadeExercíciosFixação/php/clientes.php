<?php
// clientes.php
require_once "config.php";
include      "cabecalho.php";

$stmt = $pdo->query("SELECT * FROM clientes ORDER BY nome ASC");
$clientes = $stmt->fetchAll();
?>

<h1>Módulo de Clientes</h1>
<div style='margin-bottom: 20px;'>
    <a href='cadastro_cliente.php' class="btn-link">+ Adicionar Cliente</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Endereço</th>
        </tr>
    </thead>
    <tbody>
    <?php if(empty($clientes)): ?>
        <tr><td colspan="5">Nenhum cliente registrado.</td></tr>
    <?php endif; ?>
    <?php foreach($clientes as $c): ?>
        <tr>
            <td><strong><?= htmlspecialchars($c['nome']) ?></strong></td>
            <td><?= htmlspecialchars($c['cpf']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['telefone']) ?></td>
            <td><?= htmlspecialchars($c['endereco']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include "rodape.php"; ?>