<!doctype html>
<html lang="pt-br" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="assets/css/global.css">
</head>

<body style="background-color: #34383d;" class="d-flex align-items-center pb-5">

  <form method="POST" class="container d-flex justify-content-center" action="backend/login.php">

    <div class="bg-dark rounded-4 p-5 shadow-lg d-flex justify-content-center">
      <div class="card-body">

        <div class="d-flex justify-content-center m-4"><img src="assets/img/Logo.png" class="card-img-top w-100" alt="..."></div>


        <div class="form-floating mb-3">
          <input type="email" class="form-control text-warning bg-dark" id="floatingInput" name="email" placeholder="name@example.com" required>
          <label for="floatingInput" class="">Email address</label>
        </div>
        <div class="form-floating input-group">
          <div class="form-floating">
            <input type="password" class="form-control text-warning bg-dark" id="floatingPassword" name="senha" placeholder="Password" required>
            <label for="floatingPassword" class="">Password</label>
          </div>
          <span class="btn btn-outline-secondary d-flex align-items-center" type="button" id="show-hide"><i class="fa-solid fa-eye-slash" id="iconPassword" style="color: #ffffff;"></i></span>

        </div>
      <?php
        if (isset($_GET["erro"]) && $_GET["erro"] == 404) {
          echo '<div class="form-floating mt-3 mb-3">
                <div class="alert alert-danger" role="alert">Email ou senha incorretos.<br> Tente novamente.</div>
              </div>';
        }
        ?> 
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-lg btn-warning m-2 text-dark px-5 m-5 fw-bold">Entrar</button>
        </div>

      </div>

    </div>

  </form>
  <script src="js/index.js"></script>
  <script src="https://kit.fontawesome.com/15068104d6.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  

</body>