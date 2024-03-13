<!doctype html>
<html lang="pt-br" data-bs-theme="darkAndYellow">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Consultar Tecnico</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

	<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
	<link rel="stylesheet" href="assets/css/global.css">
	<link rel="stylesheet" href="assets/css/consultar-estoque.css">
</head>

<body>
	<?php
	$html_content = file_get_contents('shared/navBar.html');
	echo $html_content;
	include 'backend/env.php';

	$con = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
	if ($con->connect_error) {
		die("Erro na conexão: " . $con->connect_error);
	}

	$sql = "SELECT nome,cpf ,email FROM tecnico;";


	$result = $con->query($sql);


	?>

	<form>
		<div class="card  m-5 shadow-lg rounded-5" id="container">

			<div class="p-2" id="containerResultado">

				<div class="row g-3 needs-validation d-flex justify-content-center">
					<h1 class="text-center my-5 text-dark">Consultar Técnicos</h1>

				</div>



			</div>


			<div class=" mx-1 mt-4 " id="containerResultado">
				<div class="row g-3 needs-validation d-flex justify-content-center">
					<table id="table" class="bg-light" data-toggle="table" data-filter-control="true" data-click-to-select="true" data-toolbar="#toolbar" data-buttons-prefix="btn" data-footer-formatter="teste" data-show-footer="true" data-show-print="true" data-mobile-responsive="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-toggle="true" data-buttons="buttons" data-show-export="true">
						<thead>
							<tr>
								<th class="text-dark" data-field="state" data-checkbox="true"></th>
								<th class="text-dark" data-field="cliente" data-alignment-select-control-options="auto" data-filter-control="select" data-searchable="true"></th>
								<th class="text-dark" data-field="cnpj" data-alignment-select-control-options="auto" data-filter-control="input" data-sortable="true"></th>
								<th class="text-dark" data-field="telefone" data-alignment-select-control-options="auto" data-filter-control="input" data-alignment-select-control-options="right"></th>
								
							</tr>
						</thead>
						<tbody>

						<?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {                                        
                                        $nome = $row['nome']; 
										$cpf = $row['cpf']; 
										$email = $row['email']; 
							
									

                                        echo "<tr>
										<td class='bs-checkbox '><input data-index='0' name='btSelectItem' type='checkbox'></td>
										<td class='text-dark'>$nome</td>
										<td class='text-dark text-center'>$cpf</td>
										<td class='text-dark'>$email</td>
								
									</tr>";
                                    }
                                }
                                ?>
						</tbody>
					</table>

				</div>



			</div>
	</form>






	<!-- JQuery -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>


	<script src="https://unpkg.com/jspdf-autotable@3.6.0/dist/jspdf.plugin.autotable.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>

	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/15068104d6.js" crossorigin="anonymous"></script>

	<!-- Boostrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

	<!-- Boostrap Table -->
	<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
	<!-- Extensions -->
	<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/print/bootstrap-table-print.min.js"></script>

	<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>

	<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>

	<script src="js/consultar-tecnico.js"></script>

</body>

</html>