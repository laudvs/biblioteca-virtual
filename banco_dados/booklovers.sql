-- =======================================
--   CRIAÇÃO DO BANCO DE DADOS
-- =======================================
CREATE DATABASE IF NOT EXISTS booklovers;
USE booklovers;

-- =======================================
--   TABELA DE USUÁRIOS
-- =======================================
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('usuario', 'admin') DEFAULT 'usuario',
    primeiro_acesso TINYINT(1) DEFAULT 0,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- =======================================
--   TABELA DE LIVROS
-- =======================================
DROP TABLE IF EXISTS livros;

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    capa VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =======================================
--   TABELA DE COMENTÁRIOS
-- =======================================
DROP TABLE IF EXISTS comentarios;

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    comentario TEXT NOT NULL,
    nota INT,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (livro_id) REFERENCES livros(id)
);

-- =======================================
--   INSERÇÃO DO ADMINISTRADOR PADRÃO
--   username: admin
--   senha: admin123
--   primeiro_acesso = 1 (vai ser obrigado a trocar)
-- =======================================
INSERT INTO usuarios (username, email, senha, tipo, primeiro_acesso)
VALUES (
    'admin',
    NULL,
    '$2y$10$FDU8bUeJ8S6I63N/7n1CmehFjvfpENeGqZp.HN82p0RZVd2kCyB.e',
    'admin',
    1
);
INSERT INTO usuarios (username, email, senha, tipo, primeiro_acesso) 
VALUES ( 
    'admin2', 
    'admin2@gmail.com', 
    '$2y$10$sDPRSfBDiERYTxzFjcZRKOIKERf4a0Q1oe2CM.pQVsaPeXvbPVCry', 
    'admin', 
    1 
);
