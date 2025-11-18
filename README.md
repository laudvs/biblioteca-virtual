# 📚 **BookLovers — Biblioteca Virtual**

O **BookLovers** é um sistema para amantes da leitura que desejam organizar suas obras, acompanhar o progresso literário e descobrir novos livros.
O projeto inclui funcionalidades de **cadastro, login e gerenciamento de livros**, sendo ideal para prática de **desenvolvimento web completo** com integração a banco de dados.
O projeto foi desenvolvido para prática de Programação Web.

---

## 🚀 **Tecnologias utilizadas**

| Área               | Tecnologias             |
| ------------------ | ----------------------- |
| 🖥️ Front-end      | HTML5, CSS3             |
| ⚙️ Back-end        | PHP                     |
| 🗄️ Banco de Dados | MySQL                   |
| 🌐 Servidor local  | XAMPP                   |

---

## ✨ **Funcionalidades**

✅ Cadastro de usuários

✅ Login por sessão

✅ Área do administrador

✅ Mensagens de erro e sucesso via `$_SESSION`

✅ Página inicial com destaques

✅ Página de listagem de livros

✅ Adição de novos livros (com formulário protegido)

✅ Sistema de comentários e avaliações

✅ Edição e exclusão de livros (CRUD completo)

🔜 **Em desenvolvimento:**

* Acompanhamento de progresso de leitura

---

## 🧠 **Objetivo do projeto**

Este projeto foi desenvolvido com fins acadêmicos e práticos, visando o aperfeiçoamento em:

* Desenvolvimento web completo (Front + Back-end)
* Integração e manipulação de banco de dados MySQL
* Segurança no armazenamento de senhas (`password_hash`)
* Controle de sessões e autenticação de usuários em PHP
* Estruturação de sistemas modulares com boas práticas

---

## 🗂️ **Estrutura do projeto**

```
BookLovers/
│
├── front-end/
│   ├── index.php
│   ├── login.php
│   ├── admin.php
│   ├── admin.css
│   ├── mudar_senha_admin.php
│   ├── cadastro.php
│   ├── livros.php
│   ├── livro_detalhe.php
│   ├── adicionar_livro.php
│   ├── style.css
│   ├── livros.css
│   ├── adicionar_livro.php
│   └── sucesso_livro.css
│
├── back-end/
│   ├── conexao.php
│   ├── cadastro.php
│   ├── cadastro_process.php
│   ├── login.php
│   ├── login_process.php
│   ├── logout.php
│   ├── processar_livro.php
│   ├── salvar_nova_senha_admin.php
│   └── livros.php
│
└── banco_dados/
    └── booklovers.sql
```

> 📁 Essa estrutura pode ser expandida conforme novas funcionalidades forem implementadas.

---

## 💾 **Banco de Dados**

```sql
CREATE DATABASE IF NOT EXISTS booklovers;
USE booklovers;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('usuario', 'admin') DEFAULT 'usuario',
    primeiro_acesso TINYINT(1) DEFAULT 0,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    capa VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    comentario TEXT NOT NULL,
    nota INT,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (livro_id) REFERENCES livros(id)
);

```

---

## ⚙️ **Como executar o projeto**

1. Instale e abra o **XAMPP**
2. Inicie os módulos **Apache** e **MySQL**
3. No **phpMyAdmin**, importe o arquivo `booklovers.sql`
4. Coloque a pasta do projeto em:
   `C:\xampp\htdocs\BookLovers`
5. Acesse pelo navegador:
   👉 [http://localhost/BookLovers/front-end/index.php](http://localhost/BookLovers/front-end/index.php)

---

## 💜 **Desenvolvido por**

👩‍💻 **Laurah Dias**
Estudante de **Sistemas de Informação** | Projeto acadêmico integrador
