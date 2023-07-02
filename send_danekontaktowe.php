<?php 
session_start();
if(ISSET($_SESSION['logged']) and $_SESSION['logged']==true){
    $_SESSION['error']="";

}
else {
    header("Location: /logowanie.php");  
    exit();      
}
function sanitize_string($input_string) {
    $safe_string = htmlspecialchars($input_string, ENT_QUOTES, 'UTF-8');
    $safe_string = stripslashes($safe_string);
    $safe_string = strip_tags($safe_string);
    return $safe_string;
}
require_once "./DBconfig.php";

    $nr_telefonu=sanitize_string($_POST['nr_telefonu']);
    $email=sanitize_string($_POST['email']);
    $Adres1=sanitize_string($_POST['Adres1']);
    $Adres2=sanitize_string($_POST['Adres2']);
    
    $zapytanie = $pdo->prepare("UPDATE `kontakt` SET `nr telefonu` = :nr_telefonu, `email` = :email, `Adres1` = :Adres1, `Adres2` = :Adres2");
    $zapytanie->execute(array(':nr_telefonu' => $nr_telefonu, ':email' => $email, ':Adres1' => $Adres1, ':Adres2' => $Adres2));
    
    if($zapytanie){
        $_SESSION['success']= "Dane zostały zaktualizowane";
        header("Location: /adminpanel.php");
    }
    else {
        echo("wystąpił błąd skontaktuj się z obsługa programu Adamem Bensari");
    }





?>