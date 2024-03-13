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
    $nomeFantasia = $_POST["nomeFantasia"];
    $dataFundacao = $_POST["dataFundacao"];
    $cnpj = $_POST["cnpj"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    // Dados de endereço
    $cep = $_POST["cep"];
    $logradouro = $_POST["logradouro"];
    $bairro = $_POST["bairro"];
    $localidade = $_POST["localidade"];
    $estado = $_POST["estado"];

    // Inicie a transação
    $con->begin_transaction();

    try {
        // Inserir o cliente na tabela Cliente
        $sql = "INSERT INTO cliente(razaoSocial, nomeFantasia, dataFundacao, cnpj, telefone, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssss", $razaoSocial, $nomeFantasia, $dataFundacao, $cnpj, $telefone, $email);
        $stmt->execute();
        $stmt->close();

        // Obter o ID do cliente inserido
        $id_Cliente = $con->insert_id;

        // Inserir o endereço associado ao cliente na tabela Endereco
        $sql2 = "INSERT INTO endereco(cep, logradouro, bairro, localidade, estado, id_Cliente) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("sssssi", $cep, $logradouro, $bairro, $localidade, $estado, $id_Cliente);
        $stmt2->execute();
        $stmt2->close();

        // Confirmar a transação
        $con->commit();

        header("Location: ../cadastro-cliente.php?register");       
    } catch (Exception $e) {
        // Em caso de erro, reverta a transação e exiba uma mensagem de erro
        $con->rollback();
        echo "Erro ao cadastrar o cliente: " . $e->getMessage();
    }

    // Feche a conexão com o banco de dados
    $con->close();
}



if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT cliente.*, endereco.id AS enderecoID, endereco.* FROM cliente, endereco WHERE cliente.id = $id AND endereco.id_Cliente = $id;";

    

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
















if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM cliente";

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

?>