<?php
include 'env.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mysqli = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if ($mysqli->connect_error) {
        die("Erro na conexão: " . $mysqli->connect_error);
    }


    $email = $_POST['email'];
    $senha = $_POST['senha'];
    

    $query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {

        header("Location: ../cadastro-cliente.php");
        echo "Login bem-sucedido!";

    } else {

        header("Location: ../index.php?erro=404");
        echo "Credenciais inválidas. Por favor, tente novamente.";
    }

    $mysqli->close();
}
?>
