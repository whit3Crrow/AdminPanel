<?php
 session_start();
 if(ISSET($_SESSION['logged']) and $_SESSION['logged']==true){
     $_SESSION['error']="";

 }
 else {
     header("Location: /logowanie.php");  
     exit();      
 }




// Sprawdzenie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    
    require_once('DBconfig.php');
    $html = $_POST['quill-content'];
    $tytuł = $_POST['tytul'];
    $id = $_POST['id'];
    $nav = $_POST['nav'];
    $old = $_POST['old'];
    $href = 'nowestrony/'.$nav.'.php';
    if(trim($html) == "" or trim($tytuł) == ""){

        $_SESSION['error2']="pola tekstowe nie mogą mogą pozostać puste";
        header("Location: /adminpanel.php");    
        exit();
    }
    
    

        try {
            $zapytanie = $pdo->prepare("UPDATE `strony` SET `html` = :html, `tytul` = :tytul, `nav` = :nav, `href` = :href WHERE `id` = :id");
            $zapytanie->execute(array(':html' => $html, ':tytul' => $tytuł,':nav'=> $nav ,':id' => $id, ':href'=>$href));
            unlink('nowestrony/'.$old.'.php');
            $template = file_get_contents('szablonstrony.php');
            $template = str_replace('{tytul}', $tytuł, $template);
            $template = str_replace('{content}', $html, $template);

            $filename = 'nowestrony/'.$nav.'.php';
            $file = fopen($filename, 'w');
            fwrite($file, $template);
            $_SESSION['success'] = "zaktualizowano stronę!";
            header("Location: /adminpanel.php");
        } catch (PDOException $e) {
            $_SESSION['error2']="Wystąpił błąd podczas dodawania usługi: " . $e->getMessage();
            header("Location: /adminpanel.php");
            exit();
        }
        
    }


    
