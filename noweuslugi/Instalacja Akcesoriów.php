<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalacja Akcesoriów</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <style>
      .ql-align-center{
        text-align: center;
      }
      
    </style>
</head>
<body>
    
    <header id="header"> 
        <div class="container">     
        <div class="navbar d-flex justify-content-end align-content-center">
        <div class="logo lead "><?php require_once '../DBconfig.php'; $zapytanie = $pdo->query("SELECT `firma` FROM inne");echo($zapytanie->fetchColumn()); ?></div>

          <div class="trzykreski">
            <div class="linia"></div>
            <div class="linia"></div>
            <div class="linia"></div>
          </div>
          <ul>
            <a href="../index.php#usługi"><li class="" >Powrót</li></a>
           <a onclick="scrollToDiv(event,'kontakt')"href="#kontakt"><li class="" >Kontakt</li></a>

          </ul>
        </div>
        </div>
      </header>
      
    
      <div id="baner"class="baner" style="background-image: url(../uploads/sowacki6_repearing_car_engine_fe78feb0-eea2-4bb6-9aa3-78eb4265b473.png);"></div>
      <div class="z">


      <div id="usługi" class="container my-5 py-3 p-0 px-lg-5 motocarslead">
        <h1 class="display-5 p-2 text-center align-content-center">Instalacja Akcesoriów</h1>
        <h5 class="lead fs-5 text-center text-dark">Zadzwoń<br><?php require_once '../DBconfig.php';
          $stmt = $pdo->query('SELECT `nr telefonu` FROM `kontakt`');
          while ($row = $stmt->fetch())   {
          echo("{$row['nr telefonu']}<br>");};
          ?>
          <div class="p-1"></div>
     
        <div class="col-12 lead fs-3 px-2 ">
            <p>Instalacja akcesoriów samochodowych to usługa polegająca na montażu różnorodnych dodatków i urządzeń w pojazdach, dzięki którym można zwiększyć komfort, bezpieczeństwo oraz funkcjonalność samochodu. Instalowane akcesoria mogą obejmować systemy nawigacji, kamery cofania, czujniki parkowania, uchwyty na rowery, bagażniki dachowe, a także różnego rodzaju elementy tunningu wizualnego czy mechanicznego.</p><p><br></p><p>Wykwalifikowani specjaliści z zakładów zajmujących się instalacją akcesoriów samochodowych są w stanie zamontować i skonfigurować różne urządzenia oraz dodatki, dbając o właściwe połączenia elektryczne, estetykę oraz bezpieczeństwo ich użytkowania. Wiele z tych usług może być realizowanych zarówno w przypadku nowych, jak i używanych pojazdów.</p><p><br></p><p>Personalizacja samochodu poprzez instalację akcesoriów pozwala na dostosowanie pojazdu do indywidualnych potrzeb i preferencji użytkownika. Dobór odpowiednich akcesoriów i ich prawidłowy montaż może znacząco wpłynąć na komfort jazdy, wartość pojazdu oraz zadowolenie z jego użytkowania.</p>
        </div>
        

</div>
    <div id="kontakt"class="p-2"></div>    
    <div class="container-fluid">
      <div class="row gap-2 justify-content-center font ">
          <div class="col-12 display-5 text-center my-3 ">Kontakt</div>
          <?php
          
          require_once '../DBconfig.php';
          $stmt = $pdo->query('SELECT * FROM `kontakt`');
          while ($row = $stmt->fetch())   {
          echo("
              <div class='col-6 col-sm-4 text-center m-4 m-md-0'> 
                <div class='fs-3 font'> Adres</div>
                  <div class='lead'>{$row['Adres1']}</div>
                  <div class='lead'>{$row['Adres2']}</div>                           
              </div>
              <div id='auto' class='col-2  'style='z-index:4;' >
                <a href='#header'><img class='auto img-fluid' src='../img/samochód.png' alt=''></a>
                <div class='lead text-center'></div>
              </div>
              <div class='col-6 col-sm-4 text-center m-4 m-md-0'>
                <div class='fs-3 text-center'> Info</div>        
                <div class='lead '>{$row['nr telefonu']}</div>
                <div class='lead '>{$row['email']}</div>            
          </div>
          ");}
          ?>
          <?php
          require_once '../DBconfig.php';
          $stmt = $pdo->query('SELECT * FROM `inne`');
          while ($row = $stmt->fetch())   {
          echo("<div class='row m-4 m-md-0'>
            <div class='col-6 '>
              <div class='text-end'>
                <div class='text-center d-inline-block  px-4'>
                {$row['text-1']}<br><div class='lead'>{$row['text-1.1']}</div></div>
              </div>
            </div>
            <div class='col-6 '>
              <div class='justify-content-end'>
                <div class='text-center  d-inline-block px-4'>
                {$row['text-2']}<br><div class='lead'>{$row['text-2.1']}</div></div>
              </div>
            </div>
          </div>
          </div>");}
        ?>
        <div class="row gap-0 justify-content-center py-2">
            <div class="col-2 text-center">
                <div class="social">
                    <img class="img-fluid" src="../img/youtube.png"></img>
                </div>
            </div>
            <div class="col-2 text-center">
                <div class="social">
                    <img class="img-fluid" src="../img/twitter_circle-512.webp"></img>
                </div>
            </div>
            <div class="col-2 text-center">
                <div class="social">
                    <img class="img-fluid" src="../img/Instagram_icon.png.webp"></img>
                </div>
            </div>
            <div class="col-2 text-center">
                <div class="social">
                    <img class="img-fluid" src="../img/facebookicon.webp"></img>
                </div>
            </div>
        </div>
          <div class="col-12 text-center font"> 
            <div id="cont" class="fs-3 text-center">
              <div class="map-container"width="100%" id="map">
                <div class="overlay"></div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2507.0384006060667!2d17.00435157403449!3d51.07084118323083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470fc3b573d9fb59%3A0xe53befd2651a910a!2sZimowa%2015B%2C%2053-018%20Wroc%C5%82aw!5e0!3m2!1spl!2spl!4v1682080764266!5m2!1spl!2spl" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="overlay-content"></div>
              </div>
            </div>
          </div>
      </div>
     
    </div>
    <script>
        function scrollToDiv(event, id) {
          event.preventDefault(); // zapobiegamy domyślnej akcji kliknięcia w link
          const div = document.getElementById(id);
          const position = div.offsetTop - 77; // pozycja diva minus 100 pikseli
          window.scroll({
            top: position,
            behavior: 'smooth' // płynne przewijanie
          });
        }
      </script>
    <script src="../aktywny.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>