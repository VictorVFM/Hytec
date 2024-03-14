<?php
include 'env.php';
$con = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique a conexão
    if ($con->connect_error) {
        die("Erro na conexão: " . $con->connect_error);
    }

    // Dados do cliente
    $razaoSocial = $_POST["razaoSocial"];
    $cnpj = $_POST["cnpj"];
    $telefone = $_POST["telefone"];


    $sql = "INSERT INTO fornecedor(razaoSocial, cnpj, telefone) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $razaoSocial, $cnpj, $telefone);
    $stmt->execute();
    $stmt->close();

    header("Location: ../cadastro-fornecedor.php?register");



    // Feche a conexão com o banco de dados
    $con->close();
}





//Procurar fornecedor por id
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM Fornecedor WHERE id=$id";    

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();

        $json_data = json_encode($cliente);
        echo $json_data;
    } else {
        echo "Nenhum resultado encontrado.";
    }
    $con->close();
}














//Listar Fornecedores
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM Fornecedor";

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
