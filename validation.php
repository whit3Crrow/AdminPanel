<?php
    require_once "./DBconfig.php";

    $login = htmlspecialchars($_POST["login"], ENT_QUOTES, 'UTF-8');
    $hasło = htmlspecialchars($_POST["haslo"], ENT_QUOTES, 'UTF-8');
    
    $recaptcha_secret = "secretkey";
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response";
    $verify_response = file_get_contents($recaptcha_url);
    $response_data = json_decode($verify_response);

    function Secure($val)
    {
        
        
        if(trim($val)=="" or preg_match('/^[a-zA-Z0-9 łżóęąźćś]+$/u', $val)==false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    
    session_start();
    
    if(Secure($login)==true and Secure($hasło)==true)
    {
        $zapytanie = $pdo->query("SELECT login, hasło FROM `1` LIMIT 1");
        $row = $zapytanie->fetch(PDO::FETCH_ASSOC);
        if (!$response_data->success) {
            $_SESSION["error"] = "Błędna weryfikacja CAPTCHA. Spróbuj ponownie.";                
            $_SESSION['logged']=false;
            header('Location: /logowanie.php'); 
            exit();


        }  
        if($login==$row['login'] and $hasło==$row['hasło']){
            $pdo = null;
            if (!$response_data->success) {
                $_SESSION["error"] = "Błędna weryfikacja CAPTCHA. Spróbuj ponownie.";                
                $_SESSION['logged']=false;
                header('Location: /logowanie.php'); 
                exit();


            }
            $_SESSION['logged']=true;
            header('Location: /adminpanel.php');
            exit();
        }
        else {
            $pdo=null;
            $_SESSION["error"]="Hasło lub login jest nie poprawny";
            header('Location: /logowanie.php');        
        }        
    }
    else
    {
        
        $_SESSION["error"]="Hasło lub login jest nie poprawny";
        header('Location: /logowanie.php');

    }
?>
