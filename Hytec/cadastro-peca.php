<!doctype html>
<html lang="pt-br" data-bs-theme="darkAndYellow">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro de Peça</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/global.css">
</head>

<body>
	<?php
	$html_content = file_get_contents('shared/navBar.html');
	echo $html_content;
	?>



	<?php

	include 'backend/env.php';
	$con = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
	if ($con->connect_error) {
		die("Erro na conexão: " . $con->connect_error);
	}

	$sql = "SELECT * FROM fornecedor";


	$result = $con->query($sql);


	?>

	<form method="POST" action="backend/peca.php" class="d-flex justify-content-center bg-light m-2">

		<div class="card mt-5 container shadow-lg rounded-5">
			<h1 class="text-center my-5 text-dark">Cadastrar Peças Novas</h1>
			<div id="containerResultado">
				<div class="row g-3 needs-validation" id="formulario">

					<div class="col-md-4 bg">
						<label for="validationDefaultUsername" class="form-label text-dark">Nome da Peça</label>
						<div class="input-group">
							<input type="text" class="form-control border border-1 border-black" name="nome" aria-describedby="inputGroupPrepend2" required>

						</div>
					</div>

					<div class="col-md-4">
						<label for="validationCustom02" class="form-label text-dark">Quantidade</label>
						<input type="number" class="form-control border border-1 border-black" value="0" name="quantidade" required>

					</div>
					<div class="col-md-3">
						<label for="validationCustom04" class="form-label text-dark">Fornecedor</label>
						<select class="form-select border border-1 border-black text-dark" name="id_Fornecedor" required>
							<option selected disabled></option>
							<?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id']; 
                                        $nome = $row['razaoSocial']; 
                                        echo "<option value='$id'>$nome</option>";
                                    }
                                }
                                ?>
						</select>
					</div>

					<div class="col-md-3">
						<label for="validationCustom03" class="form-label text-dark">Preço Unitario</label>
						<input type="number" class="form-control border border-1 border-black" name="precoUnitario" required>
					</div>
				</div>
				<div class="m-5 text-center">
					<button type="submit" class="btn btn-warning fw-bold" id="btn-cadastrar">Cadastrar</button>
				</div>
			</div>


		</div>
	</form>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="js/cadastro-peca.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="js/main.js"></script>

	<?php
        if (isset($_GET["register"])) {
        echo "<script>          
        success();  
        setTimeout(limparUrl, 4000);
        </script>";
        }
        ?>
</body>

</html>