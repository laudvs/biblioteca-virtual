<?php
session_start();

// Conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booklovers";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica erro de conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se os campos vieram via POST
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    $_SESSION['erro'] = "Preencha todos os campos!";
    header("Location: http://localhost/booklovers/front-end/login.php");
    exit();
}

// Sanitiza entradas
$username_input = trim($_POST['username']);
$password_input = trim($_POST['password']);

// Consulta preparada
$sql = "SELECT * FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username_input);
$stmt->execute();
$result = $stmt->get_result();

// Verifica usuário
if ($result->num_rows > 0) {

    $usuario = $result->fetch_assoc();

    if (password_verify($password_input, $usuario['senha'])) {

        // Login OK → Salva sessão
        $_SESSION['usuario'] = $usuario['username'];
        $_SESSION['id_usuario'] = $usuario['id'];

        $stmt->close();
        $conn->close();
        header("Location: http://localhost/booklovers/front-end/index.php");
        exit();

    } else {
        $_SESSION['erro'] = "Senha incorreta!";
        $stmt->close();
        $conn->close();
        header("Location: http://localhost/booklovers/front-end/login.php");
        exit();
    }

} else {
    $_SESSION['erro'] = "Usuário não encontrado!";
    $stmt->close();
    $conn->close();
    header("Location: http://localhost/booklovers/front-end/login.php");
    exit();
}
?>
