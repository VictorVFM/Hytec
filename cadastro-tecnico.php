<!doctype html>
<html lang="pt-br" data-bs-theme="darkAndYellow">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/img/Logo.png">
    <title>Cadastro Tecnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
</head>

<body>
    <?php
    $html_content = file_get_contents('shared/navBar.html');
    echo $html_content;
    ?> 



    <form class="d-flex justify-content-center m-2" method="POST" action="backend/tecnico.php">
        <div class="card mt-5 shadow-lg container  rounded-5">
            <h1 class="text-center my-5 text-dark">Cadastrar Tecnico</h1>
            <div>
        
                <div class="row g-3 needs-validation">
                    <div class="col-md-4 bg">
                        <label for="validationDefaultUsername" class="form-label text-dark">Nome</label>
                        <div class="input-group">
                            <input type="text" class="form-control border border-1 border-black text-dark" name="nome" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom03" class="form-label text-dark">CPF</label>
                        <input type="text" class="form-control border border-1 border-black text-dark" name="cpf" id="inputCpf" required maxlength="18" minlength="18">
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label text-dark">Data de Nascimento</label>
                        <div class="input-group has-validation">
                            <input type="date" class="form-control border border-1 border-black text-dark" name="dataNascimento" id="datepicker" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div> 
                    <div class="col-md-4 bg">
                        <label for="validationDefaultUsername" class="form-label text-dark">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control border border-1 border-black text-dark" name="email" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                    
                    <div class="m-5 text-center">
                    <button type="submit" class="btn btn-warning fw-bold" id="btn-cadastrar">Cadastrar</button>
                </div>                   
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/15068104d6.js" crossorigin="anonymous"></script>


   
<!-- 
    <?php
    if (isset($_GET["register"])) {
    }
    ?>
 -->


   
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="js/cadastro-tecnico.js"></script>
    <script src="js/main.js"></script>
    <script>
        $("#datepicker").flatpickr({
            dateFormat: "Y-m-d",
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