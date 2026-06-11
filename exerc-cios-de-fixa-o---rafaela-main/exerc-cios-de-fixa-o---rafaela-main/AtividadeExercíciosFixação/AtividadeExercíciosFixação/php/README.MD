# Projeto PHP (Padrão DAO) 

## Descrição
Este projeto foi desenvolvido em PHP utilizando o padrão DAO (Data Access Object) para acesso ao banco de dados MySQL. O sistema permite o gerenciamento de Contatos, Clientes e Produtos através das operações de cadastro, listagem, edição e exclusão.

---

## Estrutura de Pastas
Abaixo está a organização dos diretórios e arquivos que compõem a arquitetura MVC/DAO do sistema:

```text
ProjetoPHP/
│
├── config/
│   └── database.php        # Arquivo de configuração da conexão PDO com o MySQL
│
├── models/
│   ├── ContatoDAO.php      # Métodos CRUD para a tabela de contatos
│   ├── ClienteDAO.php      # Métodos CRUD para a tabela de clientes
│   └── ProdutoDAO.php      # Métodos CRUD para a tabela de produtos
│
├── uploads/                # Pasta destinada ao armazenamento de arquivos carregados
│
└── views/                  # Camada de apresentação visual (Interface)
    ├── cabecalho.php       # Estrutura HTML comum do topo da página
    ├── rodape.php          # Estrutura HTML comum do rodapé da página
    ├── funcoes.php         # Scripts e funções auxiliares do sistema
    ├── index.php           # Ponto de entrada que gerencia as views via query strings (?classe=)
    │
    ├── contatos/           # Subpágina de fluxo dos Contatos
    │   ├── contatos.php
    │   ├── lista.php
    │   ├── cadastro_contato.php
    │   ├── editar_contato.php
    │   ├── excluir_contato.php
    │   └── form.php
    │
    ├── clientes/           # Subpágina de fluxo dos Clientes
    │   ├── clientes.php
    │   ├── lista.php
    │   ├── cadastro_cliente.php
    │   ├── editar_cliente.php
    │   ├── excluir_cliente.php
    │   └── form.php
    │
    └── produtos/           # Subpágina de fluxo dos Produtos
        └── produtos.php

Tecnologias Utilizadas: 

PHP 8+

MySQL

HTML5

CSS3

XAMPP

Como Executar o Projeto: 

Certifique-se de que o Apache e o MySQL estão ativos e rodando no painel de controle do XAMPP.

Abra o terminal integrado no VS Code utilizando o atalho (Ctrl + ') diretamente na raiz do seu projeto.

Execute o comando mecânico abaixo para iniciar o servidor PHP embutido:

Bash
php -S localhost:8000
Abra o seu navegador de preferência e acesse o endereço local:

Plaintext
http://localhost:8000/views/index.php
O sistema carregará a interface principal, permitindo a navegação e o gerenciamento dos dados através dos parâmetros de classe (ex: ?classe=contatos ou ?classe=clientes).

Tabelas MYSQL: 
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