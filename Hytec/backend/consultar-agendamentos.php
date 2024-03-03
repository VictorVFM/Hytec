<?php
include 'env.php';
$con = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "INSERT INTO evento(nome, dataInicial, dataFinal) VALUES (?, ?, ?)";


    $stmt = $con->prepare($sql);

    $stmt->bind_param("sss", $nome, $dataHoraInicial, $dataHoraFinal);


    $nome = $_POST["nomeEvento"];
    $dataInicial = $_POST["dataInicial"];
    $dataFinal = $_POST["dataFinal"];
    $horaInicial = $_POST["horaInicial"];
    $horaFinal = $_POST["horaFinal"];

    $dataHoraInicial = $dataInicial.' ' . $horaInicial.':00';
    $dataHoraFinal = $dataFinal .' '. $horaFinal.':00';

    if ($stmt->execute()) {    
    header("Location: ../consultar-agendamentos.php");
    echo "Cliente cadastrado com sucesso!";
    } else {
    echo "Erro ao cadastrar o cliente: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){

    $sql = "SELECT * FROM evento";

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

if ($_SERVER["REQUEST_METHOD"] == "DELETE"){
    $id = $_GET["id"];
    $sql = "DELETE FROM Evento WHERE id = ?";


    $stmt = $con->prepare($sql);

    $stmt->bind_param("i", $id);




    

    if ($stmt->execute()) {    
    header("Location: ../consultar-agendamentos.php");
    echo "Cliente cadastrado com sucesso!";
    } else {
    echo "Erro ao cadastrar o cliente: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}




?>