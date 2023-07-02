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
    require 'DBconfig.php';

    $imie = sanitize_string($_POST['pytanie']);
    $nazwisko =sanitize_string( $_POST['odpowiedz']);
   

    if(trim($imie) == "" or trim($nazwisko) == ""){
        $_SESSION['error2'] = "Opinia nie może być pusta";
        header("Location: /adminpanel.php");  
    }
    else
    {
        try {
            $zapytanie = $pdo->prepare("INSERT INTO `faq` (`pytania`, `odpowiedzi`) VALUES (:imie,:nazwisko)");
            $zapytanie->execute(array(':imie' => $imie, ':nazwisko' => $nazwisko));
            $_SESSION['success'] = "Dodano Pytanie!";
            header("Location: /adminpanel.php");
        } catch (PDOException $e) {
            $_SESSION['error2']="Wystąpił błąd podczas dodawania Pytania: " . $e->getMessage();
            header("Location: /adminpanel.php");
            exit();
        }
    }








?>