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

    $imie = sanitize_string($_POST['imie']);
    $nazwisko =sanitize_string( $_POST['nazwisko']);
    $tresc = sanitize_string($_POST['tresc']);

    if(trim($tresc) == ""){
        $_SESSION['error2'] = "Opinia nie może być pusta";
        header("Location: /adminpanel.php");  
    }
    else
    {
        try {
            $zapytanie = $pdo->prepare("INSERT INTO `opinie` (`imie`, `tresc`, `nazwisko`) VALUES (:imie,:tresc,:nazwisko)");
            $zapytanie->execute(array(':imie' => $imie, ':nazwisko' => $nazwisko, ':tresc' => $tresc));
            $_SESSION['success'] = "Dodano opinię!";
            header("Location: /adminpanel.php");
        } catch (PDOException $e) {
            $_SESSION['error2']="Wystąpił błąd podczas dodawania opini: " . $e->getMessage();
            header("Location: /adminpanel.php");
            exit();
        }
    }








?>