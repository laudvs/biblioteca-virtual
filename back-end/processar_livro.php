<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../front-end/login.php");
    exit();
}

$usuarioId = $_SESSION['id_usuario'];

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$descricao = $_POST['descricao'];
$capa = $_POST['capa'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booklovers";

$conn = new mysqli($servername, $username, $password, $dbname);

$stmt = $conn->prepare("INSERT INTO livros (titulo, autor, descricao, capa, usuario_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $titulo, $autor, $descricao, $capa, $usuarioId);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ../front-end/livros.php");
exit();
?>
