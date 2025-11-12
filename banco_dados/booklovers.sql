CREATE DATABASE IF NOT EXISTS booklovers;
USE booklovers;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    capa VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  livro_id INT,
  usuario VARCHAR(100),
  comentario TEXT,
  nota INT,
  data DATETIME,
  FOREIGN KEY (livro_id) REFERENCES livros(id)
);

