<!doctype html>
<html lang="pt-br" data-bs-theme="darkAndYellow">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultar Agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/global.css">
</head>

<body>
    <?php
    $html_content = file_get_contents('shared/navBar.html');
    echo $html_content;
    ?>
    <div class="modal fade" id="modal-add-event" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="backend/consultar-agendamentos.php">
                        <div class="d-flex justify-content-center">
                            <div class="mb-3 w-100">
                                <label for="recipient-name" class="col-form-label">Nome do evento:</label>
                                <input type="text" class="form-control" id="recipient-name" name="nomeEvento">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">

                            <div class="mb-3 mx-2 w-50">
                                <label for="recipient-name" class="col-form-label">Data Inicial:</label>
                                <input type="date" class="form-control" id="recipient-name" name="dataInicial">
                            </div>
                            <div class="mb-3 mx-2 w-50">
                                <label for="recipient-name" class="col-form-label">Data Final:</label>
                                <input type="date" class="form-control" id="recipient-name" name="dataFinal">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mb-3 mx-2 w-50">
                                <label for="recipient-name" class="col-form-label">Hora Inicial:</label>
                                <input type="time" class="form-control input-hora" id="recipient-name" name="horaInicial">
                            </div>
                            <div class="mb-3 mx-2 w-50">
                                <label for="recipient-name" class="col-form-label">Hora Final:</label>
                                <input type="time" class="form-control input-hora" id="recipient-name" name="horaFinal">
                            </div>
                        </div>
                        <div class="form-check form-switch form-check-reverse">
                            <input class="form-check-input" type="checkbox" id="check-dia-inteiro">
                            <label class="form-check-label" for="flexSwitchCheckReverse" name="diaInteiro">Dia Inteiro</label>
                        </div>
                        <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning fw-bold">Adicionar Evento</button>
                </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>


    <form class="d-flex justify-content-center m-2 bg-light" method="POST" action="backend/cadastro-cliente.php">
        <div class="card mt-5 shadow-lg container  rounded-5">
            <div id='calendar' class="m-5"></div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.9/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.9/locales-all.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="js/consultar-agendamentos.js">

    </script>
</body>

</html>