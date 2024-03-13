<!doctype html>
<html lang="pt-br" data-bs-theme="darkAndYellow">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Cliente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="assets/css/cadastro-cliente.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
</head>

<body>
    <?php
    $html_content = file_get_contents('shared/navBar.html');
    echo $html_content;
    ?>



    <form class="d-flex justify-content-center m-2 bg-light" method="POST" action="backend/cliente.php">
        <div class="card mt-5 shadow-lg container  rounded-5">
            <h1 class="text-center my-5 text-dark">Cadastrar Cliente</h1>
            <div>
                <h2 class="justify-content-center text-dark">Dados Pessoais</h2>
                <div class="row g-3 needs-validation">
                    <div class="col-md-4 bg">
                        <label for="validationDefaultUsername" class="form-label text-dark">Razão Social</label>
                        <div class="input-group">
                            <input type="text" class="form-control border border-1 border-black text-dark" name="razaoSocial" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label text-dark">Nome Fantasia</label>
                        <input type="text" class="form-control border border-1 border-black text-dark" name="nomeFantasia" required>

                    </div>
                    <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label text-dark">Data de Fundação</label>
                        <div class="input-group has-validation">
                            <input type="date" class="form-control border border-1 border-black text-dark" name="dataFundacao" id="datepicker" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom03" class="form-label text-dark">CNPJ</label>
                        <input type="text" class="form-control border border-1 border-black text-dark" name="cnpj" id="inputCnpj" required maxlength="18" minlength="18">
                    </div>
                </div>
            </div>

            <div class="mt-2 ">
                <h2 class="justify-content-center text-dark">Contato</h2>
                <div class="row g-3 needs-validation">
                    <div class="col-md-4">
                        <label for="validationDefaultUsername" class="form-label text-dark">Telefone Celular</label>
                        <div class="input-group">
                            <input type="text" class="form-control border border-1 border-black text-dark" name="telefone" id="inputCelular" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>


                </div>
                <div class="row g-3 mt-1 needs-validation">
                    <div class="col-md-4">
                        <label for="validationCustom03" class="form-label text-dark">E-mail</label>
                        <input type="email" class="form-control border border-1 border-black text-dark" name="email" required>
                    </div>
                </div>
            </div>
            <div class=" mt-2">
                <h2 class="justify-content-center text-dark">Endereço</h2>
                <div class="row g-3 needs-validation">
                    <div class="col-md-4 bg">
                        <label for="validationDefaultUsername" class="form-label text-dark" name="cep">CEP</label>
                        <div class="input-group">
                            <input type="text" class="form-control border border-1 border-black text-dark" name="cep" id="inputCep" maxlength="9" minlength="9" aria-describedby="inputGroupPrepend2" required>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label text-dark">Logradouro</label>
                        <input type="text" class="form-control border border-1 border-black text-dark" name="logradouro" id="inputLogradouro" required>

                    </div>
                    <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label text-dark">Cidade</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control border border-1 border-black text-dark" name="localidade" id="inputCidade" aria-describedby="inputGroupPrepend" required>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label text-dark">Bairro</label>
                        <input type="text" class="form-control border border-1 border-black text-dark" name="bairro" id="inputBairro" required>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label text-dark">Estado</label>
                        <select class="form-select border border-1 border-black text-dark" name="estado" id="selectEstado" required>
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
                        <input type="text" class="form-control border border-1 border-black text-dark" name="numero" id="inputNumero" required>

                    </div>
                </div>
                <div class="m-5 text-center">
                    <button type="submit" class="btn btn-warning fw-bold" id="btn-cadastrar">Cadastrar</button>
                </div>
            </div>


        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/15068104d6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- 
    <?php
    if (isset($_GET["register"])) {
    }
    ?>
 -->



    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/cadastro-cliente.js"></script>
    <script src="js/main.js"></script>
    <script>
        $("#datepicker").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: "today",
            theme: "dark",
            allowInput: true
        });
        

        <?php
        if (isset($_GET["register"])) {
        echo "          
        success();  
        setTimeout(limparUrl, 4000);
        ";
        }
        ?>
    </script>

</body>

</html>