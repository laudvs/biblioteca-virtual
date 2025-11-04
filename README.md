## 📚 BookLovers — Biblioteca Virtual

O **BookLovers** é um sistema para amantes da leitura que desejam organizar suas obras, acompanhar progresso literário e descobrir novos livros.
O projeto inclui funcionalidades de cadastro, login e visualização de livros, sendo ideal para prática de desenvolvimento web e integração com banco de dados.

---

## 🚀 Tecnologias utilizadas

| Área           | Tecnologias             |
| -------------- | ----------------------- |
| Front-end      | HTML5, CSS3, JavaScript |
| Back-end       | PHP                     |
| Banco de Dados | MySQL                   |
| Servidor local | XAMPP                   |

---

## ✨ Funcionalidades

✅ Cadastro de usuários
✅ Login com sessão
✅ Mensagens de erro e sucesso via `$_SESSION`
✅ Página inicial com destaques
✅ Página de listagem de livros estática

🔜 Em desenvolvimento:

* Área do usuário
* CRUD de livros (adicionar, editar, excluir)
* Upload de capas
* Progresso de leitura

---

## 🧠 Objetivo do projeto

O projeto foi desenvolvido para fins acadêmicos e aprimoramento prático em:

* Desenvolvimento web completo (front + back)
* Manipulação de banco de dados
* Tratamento seguro de senhas (`password_hash`)
* Gerenciamento de sessão no PHP

---

## 🗂 Estrutura do projeto

```
BookLovers/
│
├── front-end/
│   ├── index.php
│   ├── login.php
│   ├── cadastro.php
│   ├── livros.php
│   ├── style.css
│   ├── script.js
│   └── livros.css
│
├── back-end/
│   ├── cadastrar_livro.php
│   ├── cadastro_process.php
│   ├── conexao.php
│   ├── livros.php
│   ├── login_process.php
│   └── cadastro.php
│
└── banco_dados/
    └── booklovers.sql
```

> Essa estrutura pode evoluir conforme novas funcionalidades forem criadas.

---

## 💾 Banco de Dados

```sql
CREATE DATABASE IF NOT EXISTS booklovers;
USE booklovers;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 👩‍💻 Como executar o projeto

1. Instale o **XAMPP**
2. Inicie **Apache** e **MySQL**
3. Importe o arquivo SQL no phpMyAdmin
4. Coloque o projeto em `htdocs`
5. Acesse no navegador:

```
http://localhost/BookLovers/front-end/index.php
```

---

## 💜 Desenvolvido por

**Laurah Dias** — estudante de Sistemas de Informação
