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
    $tytuł = $_POST['title'];
    $opis = $_POST['summary'];
    $id = $_POST['id'];
    $old = $_POST['old'];
    
    if(trim($html) == "" or trim($opis) == "" or trim($tytuł) == ""){

        $_SESSION['error2']="pola tekstowe nie mogą mogą pozostać puste";
        header("Location: /adminpanel.php");
        exit();
    }

    

        try {
            $zapytanie = $pdo->prepare("UPDATE `usługi` SET `html` = :html, `tytul` = :tytul, `opis` = :opis WHERE `id` = :id");
            $zapytanie->execute(array(':html' => $html, ':tytul' => $tytuł, ':opis' => $opis, ':id' => $id));
            unlink('noweuslugi/'.$old.'.php');
           
            try{
                $zapytanie = $pdo->query("SELECT `baner` FROM usługi WHERE `id` = $id");
                $baner=$zapytanie->fetchColumn();
            }
                catch(PDOException $e)
            {

            }
            $template = file_get_contents('szablonuslugi.php');
            $template = str_replace('{tytul}', $tytuł, $template);
            $template = str_replace('{content}', $html, $template);
            $template = str_replace('{baner}', $baner, $template);
            $filename = 'noweuslugi/'.$tytuł.'.php';
            $file = fopen($filename, 'w');
            fwrite($file, $template);
            $_SESSION['success'] = "zaktualizowano usługę!";
           
            header("Location: /adminpanel.php");
        } 
        catch (PDOException $e) 
        {
            
        }
        
    }


    
