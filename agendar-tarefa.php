<!doctype html>
<html lang="pt-br" data-bs-theme="darkAndYellow">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agendar Tarefa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">  
  <link rel="stylesheet" href="assets/css/global.css">
</head>

<body>
  <?php
  $html_content = file_get_contents('shared/navBar.html');
  echo $html_content;
  ?>

  <form class="d-flex justify-content-center m-2 bg-light" method="POST" action="backend/cadastro-cliente.php">
    <div class="card mt-5 shadow-lg container  rounded-5">
      <h1 class="text-center my-5 text-dark">Agendar Tarefa</h1>
      <div>
   
        <div class="row g-3 needs-validation">
        <div class="col-md-3">
                        <label for="validationCustom04" class="form-label text-dark">Tarefa</label>
                        <select class="form-select border border-1 border-black text-dark"   required>
                            <option selected disabled></option>
                            <option value="boleto">Pagamento de Boleto</option>
                           
                        </select>

                    </div>

          <div class="col-md-4">
            <label for="validationCustom02" class="form-label text-dark">Nome da Empresa</label>
            <input type="text" class="form-control border border-1 border-black text-dark" name="nomeFantasia" required>

          </div>
          <div class="col-md-4">
            <label for="validationCustomUsername" class="form-label text-dark">Data de Vencimento</label>
            <div class="input-group has-validation">
              <input type="date" class="form-control border border-1 border-black text-dark" name="dataFundacao" id="datepicker" aria-describedby="inputGroupPrepend" required>
            </div>
          </div>
          <div class="col-md-3">
            <label for="validationCustom03" class="form-label text-dark">Valor</label>
            <input type="text" class="form-control border border-1 border-black text-dark" name="cnpj" id="inputCnpj" required maxlength="18" minlength="18">
          </div>
        </div>
      </div>

      
    
        <div class="m-5 text-center">
          <button type="submit" class="btn btn-warning fw-bold" id="btn-cadastrar">Cadastrar</button>
        </div>
      </div>


    </div>
  </form>

    <script src="https://kit.fontawesome.com/15068104d6.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>