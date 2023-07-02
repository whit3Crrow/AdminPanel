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
    <title>Opinie użytkowników</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="/admin-style.css">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
</head>
<body>
    <header class="d-flex justify-content-center bg-dark text-white-50 p-2 display-1 ">Opinie przesłane z strony</header>
    <div class="m-4"></div>
    <div class="container justify-content-center align-content-center">
        <a href="index.php" target="blank"><div class=" btn btn-outline-primary m-2 shadow2 myboxshadow" id="zobacz_strone">Zobacz stronę</div></a>
        <a href="adminpanel.php"><div class="btn btn-outline-primary myboxshadow m-2 shadow2" id="wyloguj"> Panel główny</div></a>
    </div>
    <?php
       
        require_once 'DBconfig.php';
        $stmt = $pdo->query('SELECT * FROM `opinie_do_zatwierdzenia`');
        if ($stmt->rowCount() == 0) {
            echo("<div class='display-4 text-center lead text-dark-50 justify-content-center p-5'> Nie ma żadnych nowych opinii</div>");
        }
        else{
        while ($row = $stmt->fetch())   {
    echo("
        <div class='container myboxshadow rounded-3 border my-4 p-3 d-flex flex-column justify-content-center'>    
            <div class='col-12 flex-row '>
                <div class='row'>
                 <div class='col-2 author text-start p-3 text-primary'>{$row['imie']} {$row['nazwisko']}</div>
                 <div class='col-10 opinia p-3'> {$row['tresc']}</div>                    
            </div>
            <div class='col-12 flex-row'> 
                    <div id='{$row['ID']}' class='add btn btn-outline-success ' onclick='add(\"{$row['imie']}\",\"{$row['nazwisko']}\",\"{$row['tresc']}\",\"{$row['ID']}\")'>Akceptuj</div>
                    <a href='mailto:{$row['email']} ' target='blank'><div class='response btn btn-outline-primary '>Odpowiedz</div></a>
                    <div class='delete btn btn-outline-danger' id='{$row['ID']}' onclick='usun(this)'>Usuń</div>
                </div>
            </div>
    </div>
    ");}}
    ?>
</body>

<script>
function add(imie,nazwisko,tresc,id) {
    
    element = document.getElementById(id);
    // Utwórz obiekt FormData
    const formData = new FormData();
    formData.append('imie', imie);
    formData.append('nazwisko', nazwisko);
    formData.append('tresc', tresc);
    

    fetch("send_opinia.php", {
      method: "POST",
      body: formData,
    });
    usun(element);
    
  }
</script>
<script>
function usun(element) {
    const id = element.getAttribute('id');
    const dbname = 'opinie_do_zatwierdzenia';
    ((element.parentNode).parentNode).parentNode.remove();

    // Utwórz obiekt FormData
    const formData = new FormData();
    formData.append('id', id);
    formData.append('dbname', dbname);

    fetch("usun_obiekt.php", {
      method: "POST",
      body: formData,
    });
  }
</script>


</html>
