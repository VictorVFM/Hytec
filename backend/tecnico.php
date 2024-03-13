<?php
include 'env.php';
$con = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique a conexão
    if ($con->connect_error) {
        die("Erro na conexão: " . $con->connect_error);
    }

    // Dados do cliente
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $dataNascimento = $_POST["dataNascimento"];
    $email = $_POST["email"];
    echo $email;

    $sql = "INSERT INTO tecnico(nome, cpf, dataNascimento, email) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $nome, $cpf, $dataNascimento, $email);
    $stmt->execute();
    $stmt->close();

    header("Location: ../cadastro-tecnico.php?register");



    // Feche a conexão com o banco de dados
    $con->close();
}



















if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM Cliente";

    // Execute a consulta
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Array para armazenar os resultados
        $data = array();

        // Loop através dos resultados
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Converte o array em JSON
        $json_data = json_encode($data);

        // Imprime o JSON
        echo $json_data;
    } else {
        echo "Nenhum resultado encontrado.";
    }

    // Feche a conexão com o banco de dados
    $con->close();
}
