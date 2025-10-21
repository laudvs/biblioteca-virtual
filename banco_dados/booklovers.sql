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
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    descricao TEXT,
    capa VARCHAR(255)
);

INSERT INTO livros (titulo, autor, descricao, capa) VALUES
('Os Primos', 'Karen M. McManus', 'Três primos são convidados a passar o verão em uma ilha misteriosa e descobrem segredos sombrios da família.', 'https://m.media-amazon.com/images/I/71O4Xg5Vu9L._AC_UF1000,1000_QL80_.jpg'),
('Cinco Lâminas Partidas', 'Ashley Shuttleworth', 'Uma fantasia urbana envolvente sobre cinco jovens ligados por segredos, magia e traições.', 'https://m.media-amazon.com/images/I/81kJ3vYcTRL._AC_UF1000,1000_QL80_.jpg'),
('Livrai-nos do Mal', 'Amanda Robson', 'Um suspense psicológico intenso que explora mentiras, culpa e vingança entre casais aparentemente perfeitos.', 'https://m.media-amazon.com/images/I/81vTn3jEtdL._AC_UF1000,1000_QL80_.jpg');
