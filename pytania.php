<?php 
    session_start();
    if(ISSET($_SESSION['logged']) and $_SESSION['logged']==true){
        $_SESSION['error']="";

    }
    else {
        header("Location: /logowanie.php");  
        exit();      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj FAQ</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="/admin-style.css">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
</head>
<body>
    <header class="d-flex justify-content-center bg-dark text-white-50 p-2 display-1 ">Dodawanie Pytania</header>
    <div class="m-4"></div>
    <div class="container justify-content-center align-content-center">
        <a href="index.php" target="blank"><div class=" btn btn-outline-primary m-2 shadow2 myboxshadow" id="zobacz_strone">Zobacz stronę</div></a>
        <a href="adminpanel.php"><div class="btn btn-outline-primary myboxshadow m-2 shadow2" id="wyloguj"> Panel główny</div></a>
    </div>
    <div class="container myboxshadow rounded-3 border my-4 p-3">
        <form class="d-flex flex-column" method="post"  action="send_pytanie.php" >
            <label class="lead fs-3">Pytanie</label>        
            <input class="m-2 border" name="pytanie" placeholder="Często zadawane pytanie"></input>
            <label class="lead fs-3">Odpowiedź</label>
            <input class="m-2 border" name="odpowiedz" placeholder="Odp"></input>                   
            <a href="adminpanel.php"><div class="btn btn-outline-danger myboxshadow my-2 p-2 w-100">Anuluj</div></a>
            <button type="submit" class="btn btn-outline-success myboxshadow p-2 w-100">Dodaj Pytanie i Odpowiedź</button>
        </form>
    </div>
</body>
</html>
