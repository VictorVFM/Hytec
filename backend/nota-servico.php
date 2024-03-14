<?php
include 'env.php';
$con = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}


function ultimoPedido($con){
    $sql =  "SELECT * FROM notaservico WHERE ano = YEAR(CURRENT_DATE()) ORDER BY id DESC LIMIT 1;";
    // Execute a consulta
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        
        // Loop através dos resultados
        while ($row = $result->fetch_assoc()) {
           $id = $row['id'];
       
        }

        // Imprime o JSON
        return $id+1;
    } else {
        return 1;
    }
}

// Função para criar um novo registro
function criarNotaServico($con, $data) {
  $date = new DateTime();
 
  $sql = "INSERT INTO notaservico (id, ano, id_Cliente,dataNota,horario,id_Tecnico,valorTotal,observacoes)
   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($sql);
  $ultimoPedido = ultimoPedido($con);
  $ano = $date->format("Y");
  $stmt->bind_param("iiissiis",$ultimoPedido,$ano,$data["id_Cliente"],$data["dataNota"],$data["horario"],$data["id_Tecnico"],$data["valorTotal"],$data["observacoes"]);
  // Executamos a consulta
  $stmt->execute();
  
  $id_notaServico = $data["id_notaservico"];

  for($i = 0;$i < count($data["id_Peca"]);$i++){
  $sql = "INSERT INTO peca_notaservico  (id_Peca,id_Notaservico,qtd) VALUES (?, ?, ?)"; 
  $stmt = $con->prepare($sql);
  $id_Peca = $data["id_Peca"][$i];
  $id_qtdPeca = $data["quantidade"][$i];

  $stmt->bind_param("iii", $id_Peca,$id_notaServico,$id_qtdPeca);
  $stmt->execute();
  }
}

function delete_record($con, $id) {
  // Preparamos a consulta
  $sql = "DELETE FROM users WHERE id=:id";
  $stmt = $con->prepare($sql);

  // Inserimos o ID do registro
  $stmt->bindParam(":id", $id);

  // Executamos a consulta
  $stmt->execute();
}

// Função para listar todos os registros
function list_records($con) {
  $sql = "SELECT * FROM notaservico";

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
      return $json_data;
  } else {
      echo "Nenhum resultado encontrado.";
  }

  // Feche a conexão com o banco de dados
  $con->close();
}

function buscarPorId($con,$id){
  $sql = "SELECT 
  notaservico.id,
  notaservico.ano,
  notaservico.dataNota,
  notaservico.horario,
  notaservico.valorTotal,
  notaservico.observacoes,
  tecnico.nome AS nomeTecnico,
  tecnico.id AS tecnicoID,
  cliente.id AS clienteID,
  cliente.nomeFantasia,
  cliente.telefone,
  cliente.cnpj,
  endereco.cep,
  endereco.logradouro,
  endereco.localidade,
  endereco.bairro,
  endereco.estado,
  endereco.numero,
  peca.id_Peca,
  peca.qtd
FROM 
  notaservico
INNER JOIN 
  cliente ON notaservico.id_Cliente = cliente.id
INNER JOIN 
  endereco ON endereco.id_Cliente = cliente.id
INNER JOIN 
  tecnico ON tecnico.id = notaservico.id_Tecnico
LEFT JOIN 
  peca_notaservico AS peca ON notaservico.id = peca.id_Notaservico
WHERE 
  notaservico.id = $id";

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
      $json_data = $data;
      
      $json_data[0]["Pecas"] = agruparPecas($json_data);
      echo json_encode($json_data[0]);

      return json_encode($json_data[0]);
  } else {
      echo "Nenhum resultado encontrado.";
  }

  // Feche a conexão com o banco de dados
  $con->close();
}

function agruparPecas($notaservico){
  $listaPecas = array();
  for( $i = 0; $i < count($notaservico);$i++){
    $id_Peca = $notaservico[$i]["id_Peca"];
    $qtd = $notaservico[$i]["qtd"];
    $peca = array(
      'id' => $id_Peca,
      'qtd' => $qtd
    );
    
    array_push($listaPecas,$peca);
  };

  return $listaPecas;
}

// Função para tratar a requisição
function handle_request($con, $method, $path, $data) {

  // Verificamos o método HTTP
  switch ($method) {
    case "POST":
      // Criamos um novo registro
      criarNotaServico($con, $data);     
      header("Location:../nota-servico.php?register");
    case "PUT":
      // Atualizamos um registro existente
      $id = $path[2];
      // update_record($con, $id, $data);

      // Retornamos um status 200
      return ["status" => 200];
    case "DELETE":
      // Excluímos um registro existente
      $id = $path[2];
      delete_record($con, $id);

      // Retornamos um status 200
      return ["status" => 200];
    case "GET":     
      $idNota = isset($_GET['id']) ? $_GET['id'] : null;
      if ($idNota !== null) {
        // Se o ID estiver presente, buscamos um registro específico
        $record = buscarPorId($con, $idNota);

        // Verifica se o registro foi encontrado
        if ($record) {
            json_encode($record);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(array('message' => 'Registro não encontrado.'));
        }
    } else {
        // Se o ID não estiver presente, listamos todos os registros
        $records = list_records($con);

        
    }
    break;

    default:
      // Retornamos um erro
      return ["error" => "Método HTTP não suportado"];
  }
}

// Processamos a requisição
$method = $_SERVER["REQUEST_METHOD"];
$path = explode("/", $_SERVER["REQUEST_URI"]);
$data = $_POST;


// Chamamos a função para tratar a requisição
$response = handle_request($con, $method, $path, $data);
?>