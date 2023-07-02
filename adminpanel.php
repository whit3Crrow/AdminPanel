



<?php 
    session_start();
    if(ISSET($_SESSION['logged']) and $_SESSION['logged']==true){
        $_SESSION['error']="";

    }
    else {
        header("Location: ./logowanie.php");  
        exit();      
    }
    require "./DBconfig.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="./admin-style.css">    
</head>
<body>
    <header class="d-flex justify-content-center bg-dark text-white-50 p-2 display-1  ">
       
            <h1 class="jolo text-center p-4  bg-dark text-white lead display-3"><?php require_once './DBconfig.php'; $zapytanie = $pdo->query("SELECT `firma` FROM inne");echo($zapytanie->fetchColumn()); ?><h1>
          </header>
          <div class="m-4"></div>
          <div class="container justify-content-center align-content-center px-5">
                    <a href="index.php" target="blank"><div class=" btn btn-outline-primary m-2 shadow2 myboxshadow" id="zobacz_strone">Zobacz stronę</div></a>
                    <a href="logout.php"><div class="btn btn-outline-primary myboxshadow m-2 shadow2" id="wyloguj"> Wyloguj</div></a>
            </div>   
    
		<div class="container my-4  ">
        <div class="container d-flex justify-content-center position-relative w-100 p-0 m-0 h-100">
        <?php 
            if(ISSET($_SESSION['error2'])){
                echo "<div id='alert_animation'  class='alert  position-absolute  p-3 alert-danger'>{$_SESSION['error2']}</div>";
                unset($_SESSION['error2']);
                unset($_SESSION['success']);
            }
            else{
                 if(ISSET($_SESSION['success'])){
                echo "<div id='alert_animation' class='alert position-absolute   p-3 alert-success'>{$_SESSION['success']}</div>";   
                unset($_SESSION['success']);
                unset($_SESSION['error2']);
          }}
        
        ?>
        <div class="row gap-1 justify-content-center">
            <div class="col-10 my-2 col-md-5 text-center display-6 p-2 myboxshadow rounded-3 mx-1  border"> <div class="p-2  ">Strony</div> <div class="p-1"></div>
                    <div class="row">
                        <?php
                            require_once 'DBconfig.php';
                            try {
                                $stmt = $pdo->query('SELECT * FROM `strony`');
                                while ($row = $stmt->fetch())   {
                                    echo("
                                        <div class='col-12 flex-row border-top text-start lead fs-3 align-content-center eh'> &nbsp{$row['nav']} <div id='strony' class='text-danger  float-end d-flex flex-row text-end fs-4'><div class='delete' onclick='usun(this,true,false)' name='{$row['ID']}' id='{$row['ID']}'>Usuń</div> <div id='{$row['ID']}' class='text-dark mx-1' onclick='ed(\"{$row['ID']}\",false)'>Edytuj</div> </div> </div>                                            
                                        ");
                                }                                
                            } catch (PDOException $e) {
                                $_SESSION['error2']="Wystąpił błąd podczas dodawania usługi: " . $e->getMessage();                            
                                exit();
                            }
                            
                        ?>
                    </div>
            </div>
            
            <div class="col-10 my-2 col-md-5 text-center display-6 p-2 myboxshadow rounded-3  mx-1 border"> <div class="p-2 ">Usługi</div>  <div class="p-1"></div>
            <div class="row">
                        <?php
                            require_once 'DBconfig.php';
                            try {
                                $stmt = $pdo->query('SELECT * FROM `usługi`');
                                while ($row = $stmt->fetch())   {
                                    echo("
                                        <div class='col-12 flex-row border-top text-start lead fs-3 align-content-center eh' name='{$row['ID']} id='{$row['ID']}'> &nbsp{$row['tytul']} <div id='usługi' class='text-danger float-end d-flex flex-row text-end fs-4'><div class='delete' onclick='usun(this,false,true)' name='{$row['ID']}' id='{$row['ID']}'>Usuń</div> <br><div id='{$row['ID']}' onclick='ed(\"{$row['ID']}\",true)' class='text-dark mx-1'>Edytuj</div> </div> </div>                                            
                                        ");
                                }                                
                            } catch (PDOException $e) {
                                $_SESSION['error2']="Wystąpił błąd podczas dodawania usługi: " . $e->getMessage();                            
                                exit();
                            }                            
                        ?>
                    </div>
                
            </div>
            <div class="col-5 text-start "><a href="dodajstrone.php"><div class="btn btn-outline-success myboxshadow">Dodaj Stronę</div></a></div>
            <div class="col-5 text-start "><a href="dodajusługe.php"><div class="btn btn-outline-success myboxshadow">Dodaj Usługę</div></a></div>
            <div class="p-2"></div>
            <div class="col-10 my-2 display-6 p-2 myboxshadow rounded-3  border justify-content-center text-center">Dane Kontaktowe
            <table class="table fs-4 fw-light my-3 table-striped text-start">
                <thead class="text-center ">
                    <tr>
                    <th scope="col">Dane</th>
                    <th scope="col">Wartości</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php 
                    $zapytanie = $pdo->query("SELECT `nr telefonu`, `email`, `Adres1`,`Adres2` FROM kontakt");
                    $row = $zapytanie->fetch(PDO::FETCH_ASSOC);
                    echo("
                    <tr>                
                    <td>Nr telefonu</td>
                    <td>{$row['nr telefonu']}</td>                    
                    </tr>
                    <tr>                    
                    <td>Email</td>
                    <td>{$row['email']}</td>                    
                    </tr>
                    <tr>                    
                    <td>Adress Linia 1</td>
                    <td>{$row['Adres1']}</td>                                                    
                    </tr>
                    <tr>
                    <td>Adres Linia 2</td>
                    <td>{$row['Adres2']}</td>                    
                    </tr>                  
                    </tr>"
                    );?>
                </tbody>
                </table>
            </div>
            <div class="col-10"><a href="danekontaktowe.php"><div class="btn btn-outline-success myboxshadow">Edytuj</div></a></div>
            <div class="p-2"></div>            
            <div class="col-10 my-2 display-6 p-2 align-content-center myboxshadow rounded-3  border justify-content-center text-center"> <div class="p-2 ">Opinie</div><div class="p-1"></div>
                    <?php
                            require_once 'DBconfig.php';
                            try {
                                $stmt = $pdo->query('SELECT * FROM `opinie`');
                                while ($row = $stmt->fetch())   {
                                    echo("
                                        <div class='col-12 d-flex flex-row border-top justify-content-between lead fs-3  p-3' name='{$row['ID']}' id='{$row['ID']}'> <span class='d-flex flex-row w-100 justify-content-between' id='opinie'><div class='text-start fs-4' id='{$row['ID']}'> {$row['tresc']}</div> <div id='{$row['ID']}' class='text-danger fs-4' onclick='usun(this,false,false)'>Usuń</div></div> </span>                                            
                                        ");
                                }                                
                            } catch (PDOException $e) {
                                $_SESSION['error2']="Wystąpił błąd podczas dodawania usługi: " . $e->getMessage();                            
                                exit();
                            }                            
                        ?>
            </div>
            <div class="col-10"><a href="dodajopinie.php"><div class="btn btn-outline-success myboxshadow">Dodaj Nową</div></a><a href="opinie_klientow.php"><div class="btn btn-outline-success myboxshadow mx-2">Do Zatwierdzenia</div></a></div>
            <div class="p-2"></div>
            <div class="col-10 my-2 display-6 p-2 myboxshadow rounded-3  border justify-content-center text-center"> <div class="p-2"> Pytania i Odpowiedzi</div><div class="p-1"></div>
            <?php
                            require_once 'DBconfig.php';
                            try {
                                $stmt = $pdo->query('SELECT * FROM `faq`');
                                while ($row = $stmt->fetch())   {
                                    echo("
                                    <div class='col-12 d-flex flex-column border-top justify-content-between lead fs-3 p-3' name='{$row['ID']}' id='{$row['ID']}'>
                                    <div class='d-flex flex-row w-100 justify-content-between' id='faq'>
                                        <div class='text-start fs-4' id='{$row['ID']}'>{$row['pytania']}</div>
                                        <div id='{$row['ID']}' class='text-danger fs-4' onclick='usun(this)'>Usuń</div>
                                    </div>
                                    <div class='lead fs-6 text-start px-3 py-2'>-{$row['odpowiedzi']}</div>
                                </div>
                                
                                        ");
                                }                                
                            } catch (PDOException $e) {
                                $_SESSION['error2']="Wystąpił błąd w trakcie ladowania faqsprawdz połączenie z internetem   : " . $e->getMessage();                            
                                exit();
                            }                            
                        ?>

            </div>
            <div class="col-10"><a href="pytania.php"><div class="btn btn-outline-success myboxshadow">Dodaj</div></a></div>
            <div class="p-2"></div>

            <div class="col-10 my-2 display-6 p-2 myboxshadow rounded-3  border justify-content-center text-center">Inne
            <table class="table fs-4 fw-light my-3 table-striped text-start">
            <thead class="text-center ">
                    <tr>
                    <th scope="col">Dane</th>
                    <th scope="col">Wartości</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php
                                require_once 'DBconfig.php';
                                $stmt = $pdo->query('SELECT * FROM `inne`');
                                while ($row = $stmt->fetch())   {
                           echo("
                                <tr>                
                                <td>nazwa firmy</td>
                                <td>{$row['firma']}</td>                    
                                </tr>
                                <tr>                    
                                <td>dni Y =</td>
                                <td>{$row['text-1']}</td>                    
                                </tr>
                                <tr>                    
                                <td>godziny otwarcia dla dni {$row['text-1']} =</td>
                                <td>{$row['text-1.1']}</td>                                                    
                                </tr>
                                <tr>
                                <td> dni X =</td>
                                <td>{$row['text-2']}</td>                    
                                </tr> 
                                <tr>
                                <td> godziny otwarcia dla dni {$row['text-2']} =</td>
                                <td>{$row['text-2.1']}</td>                    
                                </tr>                  
                                
                                "
                        );}
                    ?>
                  </tbody>
                </table>
                
            </div>
            <div class="col-10"><a href="innedane.php"><div class="btn btn-outline-success myboxshadow">Edytuj</div></a></div>
                
            </div>
        </div>
    </div>
    </div>
</body>


<script> 

function ed(param,bool) {
    // Tworzenie niewidzialnego formularza
    const form = document.createElement('form');
    form.style.display = 'none';
    form.method = 'POST';
    if(bool){
        form.action = 'edytuj_usluge.php'; // Zastąp 'your-php-file.php' swoim plikiem PHP
    }else{
        form.action = 'edytuj_strone.php'; // Zastąp 'your-php-file.php' swoim plikiem PHP
    }

    // Dodawanie parametrów do formularza
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'id';
    input.value = param;
    form.appendChild(input);
      
    // Dodawanie formularza do strony i przekierowanie
    document.body.appendChild(form);
    form.submit();
}


function usun(element,stronabool,uslugabool) {
  const userConfirmation = confirm("Czy na pewno chcesz usunąć stronę?");

  if (userConfirmation) {
    const id = element.getAttribute('id');
    let dbname = element.parentNode.getAttribute('id');
    (element.parentNode).parentNode.remove();
   
    console.log(stronabool);
    console.log(uslugabool);
    
    // Utwórz obiekt FormData
    const formData = new FormData();
    formData.append('id', id);
    formData.append('dbname', dbname);
    formData.append('uslugabool',uslugabool);
    formData.append('stronabool',stronabool);

    fetch("./usun_obiekt.php", {
      method: "POST",
      body: formData,
    });
  }
}


                     
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>