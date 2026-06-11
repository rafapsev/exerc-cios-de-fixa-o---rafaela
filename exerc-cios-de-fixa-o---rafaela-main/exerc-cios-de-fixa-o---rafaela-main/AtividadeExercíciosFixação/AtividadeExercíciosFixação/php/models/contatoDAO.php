<?php
class contatoDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function obterContatos(string $busca = '', int $pagina = 1, int $porPagina = 5): array {
        $offset = ($pagina - 1) * $porPagina;
        $termo  = '%' . $busca . '%';
        
        $stmt = $this->pdo->prepare(
            'SELECT * FROM contatos
             WHERE nome LIKE ? OR email LIKE ?
             ORDER BY nome
             LIMIT ? OFFSET ?'
        );
        
        $stmt->bindValue(1, $termo, PDO::PARAM_STR);
        $stmt->bindValue(2, $termo, PDO::PARAM_STR);
        $stmt->bindValue(3, $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(4, $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function contarContatos(string $busca = ''): int {
        $termo = '%' . $busca . '%';
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM contatos WHERE nome LIKE ? OR email LIKE ?');
        $stmt->execute([$termo, $termo]);
        return (int) $stmt->fetchColumn();
    }

    // CORREÇÃO EXERCÍCIO 5 & 9: Encapsulando a busca por ID única
    public function obterPorId(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM contatos WHERE id = ?');
        $stmt->execute([$id]);
        $resultado = $stmt->fetch();
        return $resultado ? $resultado : null;
    }

    // CORREÇÃO EXERCÍCIO 5 & 9: Encapsulando a atualização
    public function atualizar(int $id, string $nome, string $email, string $telefone): bool {
        $stmt = $this->pdo->prepare('UPDATE contatos SET nome = ?, email = ?, telefone = ? WHERE id = ?');
        return $stmt->execute([$nome, $email, $telefone, $id]);
    }

    // CORREÇÃO EXERCÍCIO 5 & 9: Encapsulando a exclusão
    public function excluir(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM contatos WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>