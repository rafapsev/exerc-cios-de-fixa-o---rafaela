CREATE DATABASE IF NOT EXISTS agenda 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE agenda;

-- ==========================================
-- 1. TABELA E DADOS DE CONTATOS (Exercício 1)
-- ==========================================
CREATE TABLE IF NOT EXISTS contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(14) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Exercício 8: Índices de otimização para buscas textuais
CREATE INDEX idx_contatos_nome ON contatos(nome);
CREATE INDEX idx_contatos_email ON contatos(email);

-- Exercício 1 (Tarefa 6): Inserir pelo menos três registros de exemplo
INSERT INTO contatos (nome, email, telefone) VALUES
('Ana Silva', 'ana.silva@email.com', '(11) 91234-5678'),
('Bruno Costa', 'bruno.costa@email.com', '(21) 98765-4321'),
('Carla Mendes', 'carla.mendes@email.com', '(31) 99876-5432');


-- 2. TABELA E DADOS DE CLIENTES (Exercício 6)
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(14) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Exercício 8: Índice de otimização para buscas textuais
CREATE INDEX idx_clientes_nome ON clientes(nome);

-- Exercício 6: Inserir pelo menos três registros de exemplo
INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES
('Carlos Souza', '111.222.333-44', 'carlos.souza@email.com', '(11) 95555-4444', 'Rua das Flores, 123'),
('Juliana Lima', '222.333.444-55', 'juliana.lima@email.com', '(21) 96666-5555', 'Av. Central, 456'),
('Marcos Rocha', '333.444.555-66', 'marcos.rocha@email.com', '(31) 97777-6666', 'Alameda Sol, 789');



-- 3. TABELA E DADOS DE PRODUTOS (Exercício 7)
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    imagem VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Exercício 8: Índice de otimização para buscas textuais
CREATE INDEX idx_produtos_nome ON produtos(nome);

-- Exercício 7: Inserir pelo menos três registros de exemplo
INSERT INTO produtos (nome, descricao, preco, estoque, imagem) VALUES
('Notebook Pro', 'Processador Intel i7, 16GB RAM, SSD 512GB', 4500.00, 10, NULL),
('Smartphone X', 'Tela 6.5 polegadas, 128GB, Câmera Tripla', 1999.90, 25, NULL),
('Mouse Sem Fio', 'Mouse ergonômico com conexão USB wireless', 89.90, 50, NULL);


-- Teste visual para confirmar a criação e inserção de dados em todas as tabelas
SELECT * FROM contatos;
SELECT * FROM clientes;
SELECT * FROM produtos;