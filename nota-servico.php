<!doctype html>
<html lang="pt-br" data-bs-theme="darkAndYellow">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nota Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/15068104d6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/cadastro-cliente.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/nota-servico.css">
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

    $sql = "SELECT * FROM cliente";
    $sql2 = "SELECT * FROM tecnico";
    $sql3 = "SELECT * FROM peca";

    $date = new DateTime();
    $sql4 = "SELECT id,ano
    FROM notaservico
    WHERE ano = 2023
    ORDER BY id DESC
    LIMIT 1;";

    $result = $con->query($sql);
    $result2 = $con->query($sql2);
    $result3 = $con->query($sql3);
    $result4 = $con->query($sql4);
    $notaServico;
    $nServico;
    $id;
    if ($result4->num_rows > 0) {
        while ($row = $result4->fetch_assoc()) {
            $id = $row['id'] +1;
            $notaServico = $id;
            $nServico = $id . $date->format("Y");
           
        }
    }else{
        $nServico = 1 . $date->format("Y");
        $id = 1;   
    }


    function formatar_numero($numero) {
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


    <form class="d-flex justify-content-center m-2 bg-light" method='POST' action="backend/nota-servico.php">
        <div class="card mt-5 shadow-lg container rounded-5" id="containerResultado">
            <h1 class="text-center my-5 text-dark">Incluir Nota de Serviço</h1>
            <h3 class="justify-content-center text-dark">Nota Serviço: <?php
                              echo formatar_numero($nServico);
                                ?></h2>
                                
                <h2 class="justify-content-center text-dark">Dados Cliente</h2>
                <input name="id_notaservico" style="display: none;" <?php echo "value='$id'"?>>
                <input name="id_nPecas" style="display: none;" id="id_nPecas">
                <div class="row g-3 needs-validation" id="formulario">
                    <div class="col-md-4 bg">
                        <label for="validationDefaultUsername" class="form-label text-dark">Cliente</label>
                        <div class="input-group">
                            <select class="form-select border border-1 border-black text-dark" id="selectCliente" name="id_Cliente" required >
                                <option selected disabled></option>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
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
                        <input type="text" class="form-control border border-1 border-black text-dark" disabled id="inputCnpj" required maxlength="18" minlength="18">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="validationDefaultUsername" class="form-label text-dark">Telefone Celular</label>
                        <div class="input-group">
                            <input type="text" class="form-control border border-1 border-black text-dark" disabled id="inputCelular" aria-describedby="inputGroupPrepend2" required >
                        </div>
                    </div>                    
                </div>
                <div class=" mt-2">
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
                            <input type="date" class="form-control border border-1 border-black text-dark" id="datepicker" name="dataNota" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="validationCustom02" class="form-label text-dark">Horário</label>
                        <input type="text" class="form-control border border-1 border-black text-dark" name="horario" id="datepickerHour" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label text-dark">Técnico</label>
                        <div class="input-group">
                            <select class="form-select border border-1 border-black text-dark" name="id_Tecnico" required>
                                <option selected disabled></option>
                                <?php
                                if ($result2->num_rows > 0) {
                                    while ($row = $result2->fetch_assoc()) {
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
                <div id="pecas-list">
                    <div class="row g-3 needs-validation d-flex align-items-end mt-2">
                        <div class="col-md-3">
                            <label for="validationCustom05" class="form-label text-dark">Peça Utilizada</label>
                            <div class="input-group">
                                <select class="form-select border border-1 border-black text-dark peca-select" name="id_Peca[0]" required>
                                    <option selected disabled></option>
                                    <?php
                                    if ($result3->num_rows > 0) {
                                        while ($row = $result3->fetch_assoc()) {
                                            $id = $row['id'];
                                            $nome = $row['nome'];
                                            echo "<option value='$id' data-notaServico='$notaServico'>$nome</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label for="validationCustom05" class="form-label text-dark">Quantidade</label>
                            <input type="number" class="form-control border border-1 border-black text-dark peca-quantidade" name="quantidade[0]" id="datepickerHour" required>
                        </div>

                    </div>


                </div>
                <div class="row g-3 needs-validation">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-warning mt-3 fw-bold" id="adicionar-peca">Adicionar Peça</button>
                    </div>
                </div>


                <h2 class="justify-content-center text-dark mt-5">Preços e Custos</h2>
                <div class="row g-3 needs-validation">
                    <div class="col-md-4 bg">
                        <label for="validationDefaultUsername" class="form-label text-dark ">Valor Total</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control border border-1 border-black text-dark" id="inputCelular" aria-describedby="inputGroupPrepend2" name="valorTotal" required>
                        </div>
                    </div>
              
                </div>
                <div id="pecas-list">
                    <div class="row g-3 needs-validation">
                        <div class="col-md-12">
                            <label class="form-label text-dark">Observações</label>
                            <textarea class="form-control border border-1 border-black text-dark" style="height: 200px;" id="floatingTextarea2" name="observacoes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="m-4 text-center">
                    <button type="submit" class="btn btn-warning fw-bold">Cadastrar</button>
                </div>
        </div>

    </form>










    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/nota-servico.js"></script>
    <script src="js/main.js"></script>
    <?php
        if (isset($_GET["register"])) {
        echo " <script>         
        success();  
        setTimeout(limparUrl, 4000);
        </script>";
        
        }
        ?>
</body>

</html>