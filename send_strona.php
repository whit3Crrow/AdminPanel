<?php
session_start();
 if(ISSET($_SESSION['logged']) and $_SESSION['logged']==true){
     $_SESSION['error']="";

 }
 else {
     header("Location: /logowanie.php");  
     exit();      
 }

 require_once 'DBconfig.php';

 
// Sprawdzenie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nav=$_POST['nav'];
    $tytul=$_POST['tytul'];
    $html=$_POST['quill-content'];
    $html=str_replace('<img class="img-fluid" src="', '<img class="img-fluid" src="../', $html);
    if(trim($nav) == '' or trim($tytul) == '' or trim($html) == '') {
        $_SESSION['error2'] = 'pola tekstowe nie mogą być puste';
        header("Location: /adminpanel.php");
        exit();
    
    }
    try {
        $zapytanie = $pdo->prepare("INSERT INTO `strony` (`html`, `nav`, `tytul`,`href`) VALUES (:html,:nav,:tytul,:href)");
        $zapytanie->execute(array(':html' => $html, ':tytul' => $tytul, ':nav' => $nav, ':href' => 'nowestrony/'.$nav.'.php'));
        $_SESSION['success'] = "Dodano stronę !";
        $template = file_get_contents('szablonstrony.php');
        $template = str_replace('{tytul}', $tytul, $template);
        $template = str_replace('{content}', $html, $template);        
        $filename = 'nowestrony/'.$nav.'.php';
        $file = fopen($filename, 'w');
        fwrite($file, $template);
        fclose($file);
        header("Location: /adminpanel.php");
    } catch (PDOException $e) {
        $_SESSION['error2']="Wystąpił błąd podczas dodawania usługi: " . $e->getMessage();
    
        exit();
    }

}else{



}