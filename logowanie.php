<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.84.0">
    <meta name="robots" content="noindex">
    <title>Zaloguj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  </head>
  <body class="text-center">
    
<main class="form-signin">
    <div class="alert-danger  rounded-3  m-3"><?php session_start(); if(ISSET($_SESSION["error"])){echo($_SESSION["error"]);} ?></div>
  <form action="validation.php" method="POST">
    <h1 class="h3 mb-3 fw-normal">Zaloguj się</h1>

    <div class="form-floating">
      <input class="form-control my-2" id="floatingInput" name="login" placeholder="name@example.com">
      <label for="floatingInput">User</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="haslo" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LfpSbQlAAAAAPUYFYaLFJhq1ovEBubxGMmQJM8o"></div>
    </div>
    <button class="w-100 btn btn-lg btn-primary my-1" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; Zakład Mechaniczny u Jacka</p>
  </form>
</main>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
