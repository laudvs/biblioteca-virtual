<?php
session_start();

// Apenas administradores logados podem acessar
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

// Conexão com o banco
require_once '../back-end/conexao.php';

// Determinar qual aba está ativa
$aba = isset($_GET['aba']) ? $_GET['aba'] : 'livros';

// Processar exclusões
if (isset($_GET['acao'])) {
  $acao = $_GET['acao'];
  $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

  if ($acao === 'deletar_livro' && $id > 0) {
    $stmt = $conn->prepare("DELETE FROM livros WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php?aba=livros&msg=Livro deletado com sucesso");
    exit();
  }

  if ($acao === 'deletar_usuario' && $id > 0) {
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php?aba=usuarios&msg=Usuário deletado com sucesso");
    exit();
  }

  if ($acao === 'deletar_comentario' && $id > 0) {
    $stmt = $conn->prepare("DELETE FROM comentarios WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php?aba=comentarios&msg=Comentário deletado com sucesso");
    exit();
  }
}

// Buscar dados conforme aba ativa
$usuarios = [];
$livros = [];
$comentarios = [];

if ($aba === 'usuarios') {
  $res = $conn->query("SELECT id, username, email, tipo, data_criacao FROM usuarios ORDER BY id DESC");
  while ($row = $res->fetch_assoc()) { $usuarios[] = $row; }
  $res->close();
}

if ($aba === 'livros') {
  $res = $conn->query("SELECT * FROM livros ORDER BY id DESC");
  while ($row = $res->fetch_assoc()) { $livros[] = $row; }
  $res->close();
}

if ($aba === 'comentarios') {
  $res = $conn->query("SELECT id, livro_id, usuario, comentario, nota, data FROM comentarios ORDER BY data DESC");
  while ($row = $res->fetch_assoc()) { $comentarios[] = $row; }
  $res->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - BookLovers</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="admin.css">
</head>

<body>
  <header class="header">
    <div class="logo">
      <i class="fa-solid fa-book-open-reader"></i>
      <h1>Booklovers Admin</h1>
    </div>

    <nav class="navbar">
      <span class="admin-info">👤 <?= htmlspecialchars($_SESSION['admin']); ?></span>
      <a href="../back-end/logout.php" class="btn-logout">Sair</a>
    </nav>
  </header>

  <section class="admin-container">
    <div class="tabs-navigation">
      <a href="?aba=livros" class="tab-btn <?= $aba === 'livros' ? 'active' : '' ?>">
        <i class="fas fa-book"></i> Livros
      </a>
      <a href="?aba=usuarios" class="tab-btn <?= $aba === 'usuarios' ? 'active' : '' ?>">
        <i class="fas fa-users"></i> Usuários
      </a>
      <a href="?aba=comentarios" class="tab-btn <?= $aba === 'comentarios' ? 'active' : '' ?>">
        <i class="fas fa-comments"></i> Comentários
      </a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success">
        ✅ <?= htmlspecialchars($_GET['msg']); ?>
      </div>
    <?php endif; ?>

    <!-- ABA: LIVROS -->
    <?php if ($aba === 'livros'): ?>
      <div class="tab-content">
        <h2><i class="fas fa-book"></i> Gerenciar Livros</h2>

        <?php if (count($livros) > 0): ?>
            <div class="livros-grid">
              <?php foreach ($livros as $livro): ?>
                <div class="livro-block">
                  <div class="livro-info">
                    <h3><?= htmlspecialchars($livro['titulo']); ?></h3>
                    <p class="autor"><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']); ?></p>
                    <p class="descricao"><?= htmlspecialchars(substr($livro['descricao'], 0, 80) . '...'); ?></p>
                    <div class="livro-actions">
                      <a href="?aba=livros&acao=deletar_livro&id=<?= $livro['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Tem certeza que deseja deletar este livro?');">
                        <i class="fas fa-trash"></i> Deletar
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
        <?php else: ?>
          <p class="empty-state">Nenhum livro cadastrado.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- ABA: USUÁRIOS -->
    <?php if ($aba === 'usuarios'): ?>
      <div class="tab-content">
        <h2><i class="fas fa-users"></i> Gerenciar Usuários</h2>

        <?php if (count($usuarios) > 0): ?>
          <div class="table-responsive">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Usuário</th>
                  <th>Email</th>
                  <th>Tipo</th>
                  <th>Data de Criação</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                  <tr>
                    <td><?= $usuario['id']; ?></td>
                    <td><strong><?= htmlspecialchars($usuario['username']); ?></strong></td>
                    <td><?= htmlspecialchars($usuario['email'] ?? '—'); ?></td>
                    <td>
                      <span class="badge <?= $usuario['tipo'] === 'admin' ? 'badge-admin' : 'badge-user' ?>">
                        <?= ucfirst($usuario['tipo']); ?>
                      </span>
                    </td>
                    <td><?= date('d/m/Y', strtotime($usuario['data_criacao'])); ?></td>
                    <td>
                      <?php if ($usuario['username'] !== $_SESSION['admin']): ?>
                        <a href="?aba=usuarios&acao=deletar_usuario&id=<?= $usuario['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Tem certeza que deseja deletar este usuário?');">
                          <i class="fas fa-trash"></i> Deletar
                        </a>
                      <?php else: ?>
                        <span class="text-muted">—</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <p class="empty-state">Nenhum usuário cadastrado.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- ABA: COMENTÁRIOS -->
    <?php if ($aba === 'comentarios'): ?>
      <div class="tab-content">
        <h2><i class="fas fa-comments"></i> Gerenciar Comentários</h2>

        <?php if (count($comentarios) > 0): ?>
          <div class="comments-list">
            <?php foreach ($comentarios as $com): ?>
              <div class="comment-card">
                <div class="comment-header">
                  <strong><?= htmlspecialchars($com['usuario']); ?></strong>
                  <span class="badge badge-note">⭐ <?= (int)$com['nota']; ?>/5</span>
                  <span class="comment-date"><?= date('d/m/Y H:i', strtotime($com['data'])); ?></span>
                </div>
                <p class="comment-text"><?= nl2br(htmlspecialchars($com['comentario'])); ?></p>
                <div class="comment-footer">
                  <small>Livro ID: <?= $com['livro_id']; ?></small>
                  <a href="?aba=comentarios&acao=deletar_comentario&id=<?= $com['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Tem certeza que deseja deletar este comentário?');">
                    <i class="fas fa-trash"></i> Deletar
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="empty-state">Nenhum comentário cadastrado.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </section>

  <footer class="footer">
    <p>📖 Booklovers © 2025 | Painel de Administração</p>
  </footer>
</body>
</html>

<?php $conn->close(); ?>
