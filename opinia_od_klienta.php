<?php
function sanitize_string($input_string) {
    $safe_string = htmlspecialchars($input_string, ENT_QUOTES, 'UTF-8');
    $safe_string = stripslashes($safe_string);
    $safe_string = strip_tags($safe_string);
    return $safe_string;
}
session_start();
require_once 'DBconfig.php';
UNSET($_SESSION['form_success']);
UNSET($_SESSION['form_error']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   
    // Sanitize input data
    $safe_name = sanitize_string($_POST['imie']);
    $safe_lastname = sanitize_string($_POST['nazwisko']);
    $safe_email = sanitize_string($_POST['email']);
    $safe_comment = sanitize_string($_POST['tresc']);

    if(strlen($safe_name) >=14){
        $_SESSION['form_error']="nieprawidłowe imię";
        header('Location: index.php#PrześlijOpinię');
        exit();
    }
    else if(trim($safe_comment) == '' and trim($safe_lastname) == '' and trim($safe_name) == '' and trim($safe_email) == ''){
        $_SESSION['form_error']="Żadne z pul tekstowych nie mogą być puste";
        header('Location: index.php#PrześlijOpinię');
        exit();
    }
    else if(strpos($safe_email,'@')==false or strpos($safe_email,'.')==false){
        $_SESSION['form_error']="nieprawidłowy email";
        header('Location: index.php#PrześlijOpinię');
        exit();
    }
    else if(strlen($safe_email) > 100){
        $_SESSION['form_error']="Przekoczyłeś limit znaków (limit dla email wynosi 100) ";
        header('Location: index.php#PrześlijOpinię');
        exit();
    }
    else if(strlen($safe_comment) > 800){
        $_SESSION['form_error']="Przekoczyłeś limit znaków (limit dla treści opini wynosi 800) ";
        header('Location: index.php#PrześlijOpinię');
        exit();
    }
    else if(strlen($safe_lastname) >= 50){        
        $_SESSION['form_error']="Przekoczyłeś limit znaków (limit dla nazwiska wynosi 70 znaków)";
        header('Location: index.php#PrześlijOpinię');
        exit();
    }
    else if($_SESSION['opinie']>=2){
        $_SESSION['form_error']="Dwie opinie wystarczą";
        header('Location: index.php#PrześlijOpinię');
        exit();
    }

    try {
        $zapytanie = $pdo->prepare("INSERT INTO `opinie_do_zatwierdzenia` (`email`,`Imie`, `Nazwisko`, `Tresc`) VALUES (:email, :imie, :nazwisko, :tresc)");
        $zapytanie->execute(array(':email' => $safe_email, ':imie' => $safe_name, ':nazwisko' => $safe_lastname, ':tresc' => $safe_comment));
        $_SESSION['form_success']='Przesłano opinię do weryfikacji';
        UNSET($_SESSION['form_error']);
        header("Location: /index.php#PrześlijOpinię");
        $_SESSION['opinie']-=1;
        exit();
    } catch (PDOException $e) {
        $_SESSION['error2']="Wystąpił błąd podczas dodawania opini: " . $e->getMessage();
        header("Location: /index.php#PrześlijOpinię");
        exit();
    }
}


?>



