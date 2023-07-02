<!doctype html>
<html lang="en">
  <head>
    <?php session_start(); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <title>Mechanik - Wrocław</title>
    <link rel="stylesheet" href="style.css">
    
  </head>
  <body>
    <div class="wrapper">
    <header id="header"> 
      <div class="container">     
      <div class="navbar d-flex justify-content-end align-content-center">
        <div class="logo lead "><?php require_once 'DBconfig.php'; $zapytanie = $pdo->query("SELECT `firma` FROM inne");echo($zapytanie->fetchColumn()); ?></div>
        <div class="trzykreski">
          <div class="linia"></div>
          <div class="linia"></div>
          <div class="linia"></div>
        </div>
          <ul>
            <?php 
            require_once 'DBconfig.php';            
              $stmt = $pdo->query('SELECT * FROM `strony`');
              while ($result = $stmt->fetch()){
                echo("
                  <a onclick='scrollToDiv(event,'{$result['nav']}')' href='{$result['href']}'><li class='' >{$result['nav']}</li></a>
                ");
              }
            ?>
            <a onclick="scrollToDiv(event,'onas')" href="#onas"><li class="" >O nas</li></a>
            <a onclick="scrollToDiv(event,'usługi')"href="#usługi"><li class="" >Usługi</li></a>
           <a onclick="scrollToDiv(event,'opinie')"href="#opinie"><li class="" >Opinie</li></a>
           <a onclick="scrollToDiv(event,'kontakt')"href="#kontakt"><li class="" >Kontakt</li></a>
           <a onclick="scrollToDiv(event,'pytania')"href="#pytania"><li class="" >Pytania</li></a>
           <a href="adminpanel.php"><li>Admin</li></a>
            

          </ul>
      </div>
      </div>
    </header>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        
        <div class="carousel-item active" style="background-image: url('img/pexels-andrea-piacquadio-3807811.jpg');">
          <div class="carousel-caption shadow-4 custom-carousel-caption">
            <h5  class="display-5">Kochamy naprawiać</h5>
            <p class="lead font-shadow-black">Zaufaj specjalistom, zajmiemy się każdym problemem twojego pojazdu</p>
            <br>
          </div>
        </div>
        <div class="carousel-item " style="background-image: url('img/pexels-andrea-piacquadio-3806249.jpg');">
          <div class="carousel-caption shadow-4 custom-carousel-caption">
            <h5 class="display-5">Z każdą...</h5>
            <p class="lead font-shadow-black">Z jaką maksymalną prędkością można przejechać ten zakręt?</p><br>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('img/pexels-christina-voinova-7367864.jpg');">
          <div class="carousel-caption shadow-4 custom-carousel-caption">
            <h5 class="display-5">Specjaliści</h5>
            <p class="lead font-shadow-black">Nasi mechanicy przeszli dodatkowe szkolenia, które czynią ich wybitnymi specjalistami </p><br>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div id="onas"></div>
    <div class="container my-4 py-4">      
      <div class="row gap-3 mt-5 justify-content-center align-content-center">
          <div  class="col-12 col-lg-5 d-flex justify-content-center align-items-center"> <div class="position-relative overflow-hidden"> <div class="nakladka"></div><img src="./img/autostare.png" class="rounded-3 shadow motocarslead2 img-zoom img-fluid"></img></div> </div>
          <div class="col-12 col-lg-5 motocarslead mycentredtext"> <div class="display-2 "><?php require_once 'DBconfig.php'; $zapytanie = $pdo->query("SELECT `firma` FROM inne");echo($zapytanie->fetchColumn()); ?></div> <div class="lead"> Specjalizujemy się w sprzedaży, serwisie oraz wynajmie samochodów osobowych i dostawczych zarówno z silnikami spalinowymi, jak i elektrycznymi. Nasza misja to dostarczenie naszym klientom najwyższej jakości usług i produktów w przystępnych cenach.</div> </div>
      </div>
  </div>
  <div class="p-1"></div>

     <div id="usługi" class="container my-5 py-3 p-0 px-lg-5 motocarslead">
           <h1 class="display-5 p-2 text-center align-content-center">Nasze Usługi</h1>
           <h5 class="lead fs-5 text-center text-dark">Zadzwoń<br><?php require_once './DBconfig.php';
          $stmt = $pdo->query('SELECT `nr telefonu` FROM `kontakt`');
          while ($row = $stmt->fetch())   {
          echo("{$row['nr telefonu']}<br>");};
          ?></h5>
          <row class="row justify-content-center align-content-center text-satrt p-4">
          <?php 
            require_once 'DBconfig.php';            
              $stmt = $pdo->query('SELECT * FROM `usługi`');
              while ($result = $stmt->fetch()){
                echo("
                <div class='col-12 fs-4 col-lg-4 kafel py-3 my-2' ><a href='noweuslugi/{$result['tytul']}.php'><img src='uploads/{$result['miniatura']}' class='ikony img-fluid'></img> <div class='con-1'> {$result['tytul']} <div class='lead fs-6'>{$result['opis']}<span><button class='btn mx-2 shadow rounded position-absolute my-3 btn-outline-primary fs-7 p-1'>Dalej</button></span></div> </div></div></a>

                ");
              }
            ?>
        </row>
        <div class="p-4"></div>
      </div>

 
    <div id="opinie" class="container-fluid px-0 py-2 my-5 border-2 position-relative text-black bg-white border-1 d-flex flex-column justify-content-center align-items-center">
      <div class="display-5 p-1">Opinie</div>
      <div class="p-3"></div>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <?php
          require_once 'DBconfig.php';
          $stmt = $pdo->query('SELECT * FROM `opinie`');
          while ($row = $stmt->fetch())   {
                echo("  <div class='swiper-slide flex-column'>
                  <div class='fs-4 lead py-3 text-primary'>{$row['imie']} {$row['nazwisko']}</div>
                  <div id='tekst_opini' class='lead fs-5 p-3 justify-content-center align-content-center text-center'>{$row['tresc']}</div>            
                  <div class='p-3'></div>  
                </div>");
          }                          
          ?>
          </div>          
      </div>
        <div id='PrześlijOpinię' class="lead fs-4 p-4">Prześlij nam swoje spostrzeżenia jesteśmy również otwarci na krytykę :)</div>
        <div class="text-danger lead fs-4 text-center "><?php if(ISSET($_SESSION['form_error'])){  echo($_SESSION['form_error']);} ?></div>
          <div class="text-success lead fs-4 text-center "><?php if(ISSET($_SESSION['form_success'])){echo($_SESSION['form_success']);} ?></div>
          <div class="p-2"></div>
        <form class="row p-1" method='POST' action='opinia_od_klienta.php'>
          <div class="col">
            <input type="text" class="form-control" placeholder="Imię" name="imie"  id="imie">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Nazwisko" name="nazwisko" id="nazwisko">
          </div>
          <div class="col-12 my-3">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
          </div>
          <div class="col-12">
            <input type="text" class="form-control" placeholder="Wiadomość" name="tresc"  id="tresc">
          </div>
          <div class="col-12 d-flex justify-content-center align-items-center">
            <button type='submit' class="btn btn-outline-primary my-3">Prześlij Opinię</button>
          </div>
        </form>
      <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
      <script>
        var swiper = new Swiper(".mySwiper", {
          effect: "cards",
          grabCursor: true,
        });
      </script>
    </div>
    
    <div id="kontakt"class=""></div>    
    <div class="container-fluid p-0">
      <div class="row gap-2 justify-content-center font ">
          <div class="col-12 display-5 text-center my-3 ">Kontakt</div>
          <?php
          require_once 'DBconfig.php';
          require_once 'DBconfig.php';
          $stmt = $pdo->query('SELECT * FROM `kontakt`');
          while ($row = $stmt->fetch())   {
          echo("
              <div class='col-6 col-sm-4 text-center m-4 m-md-0'> 
                <div class='fs-3 font'> Adres</div>
                  <div class='lead'>{$row['Adres1']}</div>
                  <div class='lead'>{$row['Adres2']}</div>                           
              </div>
              <div id='auto' class='col-2  'style='z-index:4;' >
                <a href='#header'><img class='auto img-fluid' src='./img/samochód.png' alt=''></a>
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
          require_once 'DBconfig.php';
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
                    <img class="img-fluid" src="./img/youtube.png"></img>
                </div>
            </div>
            <div class="col-2 text-center">
                <div class="social">
                    <img class="img-fluid" src="./img/twitter_circle-512.webp"></img>
                </div>
            </div>
            <div class="col-2 text-center">
                <div class="social">
                    <img class="img-fluid" src="./img/Instagram_icon.png.webp"></img>
                </div>
            </div>
            <div class="col-2 text-center">
                <div class="social">
                    <img class="img-fluid" src="./img/facebookicon.webp"></img>
                </div>
            </div>
        </div>
          <div class="col-12 text-center font"> 
            <div id="cont" class="fs-3 text-center">
              <div class="map-container"width="100%" id="map">
                <div class="overlay"></div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2507.03dODAJ84006060667!2d17.00435157403449!3d51.07084118323083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470fc3b573d9fb59%3A0xe53befd2651a910a!2sZimowa%2015B%2C%2053-018%20Wroc%C5%82aw!5e0!3m2!1spl!2spl!4v1682080764266!5m2!1spl!2spl" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="overlay-content"></div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div id="pytania">
      <div class="container d-flex flex-column justify-content-center align-content-center ">
            <div class="text-center display-4 p-4">Pytania i Odpowiedzi</div>
            
            <?php
              echo("<div class='accordion accordion-flush' id='accordionFlushExample'>");
              require_once 'DBconfig.php';
              $stmt = $pdo->query('SELECT * FROM `faq`');
              while ($row = $stmt->fetch())   {
                    echo("
                    <div class='accordion-item'>
                      <h2 class='accordion-header border' id='flush-headingOne'>
                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseOne{$row['ID']}' aria-expanded='false' aria-controls='flush-collapseOne{$row['ID']}'>
                          {$row['pytania']}
                        </button>
                      </h2>
                      <div id='flush-collapseOne{$row['ID']}' class='accordion-collapse collapse' aria-labelledby='flush-headingOne' data-bs-parent='#accordionFlushExample'>
                        <div class='accordion-body border fw-bold'> 
                          {$row['odpowiedzi']}
                        </div>
                      </div>");}

            echo("</div>");

                ?>
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
    <script src="aktywny.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      </div>
  </body>
  
</html>