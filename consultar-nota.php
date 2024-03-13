<!doctype html>
<html lang="pt-br" data-bs-theme="darkAndYellow">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultar Nota de Servico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/consultar-estoque.css">
</head>
<style>
    .fht-cell {
        height: 34px;
    }
</style>

<body>
    <?php
    $html_content = file_get_contents('shared/navBar.html');
    echo $html_content;
    include 'backend/env.php';
    $con = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if ($con->connect_error) {
        die("Erro na conexão: " . $con->connect_error);
    }

    $sql = "SELECT notaservico.id ,ano,dataNota,cliente.nomeFantasia FROM notaservico,cliente  where notaservico.id_Cliente = cliente.id";
    $sql2 = "SELECT * FROM cliente";
    $sql3 = "SELECT * FROM tecnico";

    $result = $con->query($sql);
    $result2 = $con->query($sql2);
    $result3 = $con->query($sql3);


    function formatar_numero($numero)
    {

        $numero = str_replace("^0+", "", $numero);
        // Adicionamos os zeros à esquerda
        while (strlen($numero) < 10) {
            $numero = "0" . $numero;
        }
        $numero[0] = "#";
        // Retornamos o número formatado
        return $numero;
    }

    ?>


    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90%; ">
            <div class="modal-content">
                <div class="modal-header d-flex">

                    <h5 class="modal-title" id="exampleModalLabel">Visualizar Nota</h5>
             

                </div>
                <div class="modal-body">
                    <form>
                        <h2 class="justify-content-center text-dark">Dados Cliente</h2>
                        <div class="row g-3 needs-validation" id="formulario">
                            <div class="col-md-4 bg">
                                <label for="validationDefaultUsername" class="form-label text-dark">Cliente</label>
                                <div class="input-group">
                                    <select class="form-select border border-1 border-black text-dark" id="selectCliente" name="inputCliente" required disabled>
                                        <option disabled></option>
                                        <?php
                                        if ($result2->num_rows > 0) {
                                            while ($row = $result2->fetch_assoc()) {
                                                $id = $row['id'];
                                                $nome = $row['nomeFantasia'];
                                                echo "<option value='$id'>$nome</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustom03" class="form-label text-dark">CNPJ</label>
                                <input type="text" class="form-control border border-1 border-black text-dark" disabled id="inputCnpj" name="cnpj" required maxlength="18" minlength="18">
                            </div>

                            <div class="col-md-4">
                                <label for="validationDefaultUsername" class="form-label text-dark">Telefone Celular</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border border-1 border-black text-dark" disabled id="inputCelular" aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <h2 class="justify-content-center text-dark">Endereço</h2>
                            <div class="row g-3 needs-validation">
                                <div class="col-md-4 bg">
                                    <label for="validationDefaultUsername" class="form-label text-dark" name="cep">CEP</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border border-1 border-black text-dark" name="cep" id="inputCep" maxlength="9" minlength="9" aria-describedby="inputGroupPrepend2" required disabled>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label text-dark">Logradouro</label>
                                    <input type="text" class="form-control border border-1 border-black text-dark" name="logradouro" id="inputLogradouro" required disabled>

                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustomUsername" class="form-label text-dark">Cidade</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control border border-1 border-black text-dark" name="localidade" id="inputCidade" aria-describedby="inputGroupPrepend" required disabled>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom03" class="form-label text-dark">Bairro</label>
                                    <input type="text" class="form-control border border-1 border-black text-dark" name="bairro" id="inputBairro" required disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom04" class="form-label text-dark">Estado</label>
                                    <select class="form-select border border-1 border-black text-dark" name="estado" id="selectEstado" required disabled>
                                        <option selected disabled></option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>

                                </div>
                                <div class="col-md-3">
                                    <label for="validationCustom05" class="form-label text-dark">Numero</label>
                                    <input type="text" class="form-control border border-1 border-black text-dark" name="numero" id="inputNumero" disabled>

                                </div>
                            </div>
                        </div>
                        <h2 class="justify-content-center text-dark mt-5">Detalhes do Serviço</h2>
                        <div class="row g-3 needs-validation" id="formulario">
                            <div class="col-md-4 bg">
                                <label for="validationDefaultUsername" class="form-label text-dark">Data</label>
                                <div class="input-group has-validation">
                                    <input type="date" class="form-control border border-1 border-black text-dark" id="inputDataNota" name="dataNota" aria-describedby="inputGroupPrepend" required disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="validationCustom02" class="form-label text-dark">Horário</label>
                                <input type="time" class="form-control border border-1 border-black text-dark" name="horario" id="inputHorario" required disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustomUsername" class="form-label text-dark">Técnico</label>
                                <div class="input-group">
                                    <select class="form-select border border-1 border-black text-dark" name="id_Tecnico" id="inputTecnico" required disabled>
                                        <option selected disabled></option>
                                        <?php
                                        if ($result3->num_rows > 0) {
                                            while ($row = $result3->fetch_assoc()) {
                                                $id = $row['id'];
                                                $nome = $row['nome'];
                                                echo "<option value='$id'>$nome</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="pecas-list"></div>



                        <h2 class="justify-content-center text-dark mt-5">Preços e Custos</h2>
                        <div class="row g-3 needs-validation">
                            <div class="col-md-4 bg">
                                <label for="validationDefaultUsername" class="form-label text-dark ">Valor Total</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control border border-1 border-black text-dark" id="inputValorTotal" aria-describedby="inputGroupPrepend2" name="valorTotal" required disabled>
                                </div>
                            </div>
                        </div>
                        <div id="pecas-list">
                            <div class="row g-3 needs-validation">
                                <div class="col-md-12">
                                    <label class="form-label text-dark">Observações</label>
                                    <textarea class="form-control border border-1 border-black text-dark" style="height: 200px;" id="inputObservacoes" name="observacoes" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-warning">Imprimir</button>
                </div>
            </div>
        </div>
    </div>

    <form>
        <div class="card  m-5 shadow-lg rounded-5" id="container">

            <div class="p-2" id="containerResultado">

                <div class="row g-3 needs-validation d-flex justify-content-center">
                    <h1 class="text-center my-5 text-dark">Consultar Nota de Serviço</h1>

                </div>



            </div>


            <div class=" mx-1 mt-4 " id="containerResultado">
                <div class="row g-3 needs-validation d-flex justify-content-center">
                    <table id="table" class="bg-light" data-toggle="table" data-filter-control="true" data-click-to-select="true" data-buttons-prefix="btn" data-show-footer="true" data-show-print="true" data-mobile-responsive="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-toggle="true" data-buttons="buttons" data-show-export="true">
                        <thead>
                            <tr>
                                <th class="text-dark" data-field="note" data-alignment-select-control-options="auto" data-filter-control="input" data-searchable="true"></th>
                                <th class="text-dark" data-field="name" data-alignment-select-control-options="auto" data-filter-control="select" data-sortable="true"></th>
                                <th class="text-dark" data-field="date" data-alignment-select-control-options="auto" data-filter-control="input" data-sortable="true" data-alignment-select-control-options="right"></th>
                                <th class="text-dark text-center" data-field="action" data-alignment-select-control-options="auto"></th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['id'];
                                    $ano = $row['ano'];
                                    $nomeFantasia = $row['nomeFantasia'];
                                    $dataNota = $row['dataNota'];
                                    $nServico = $id . $ano;
                                    $nServico = formatar_numero($nServico);
                                    echo "<tr>
										<td class='text-dark'>$nServico</td>
										<td class='text-dark'>$nomeFantasia</td>
										<td class='text-dark text-center'>$dataNota</td>
                                        <td class='justify-content-around d-flex'><button type='button' class='btn btn-success' id='btn-edit' data-id='$id' onclick='clicarNota(this)'><i class='bi bi-filter-square'></i></button>         
                                       
							
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

    <script src="js/consultar-nota.js"></script>


</body>

</html>