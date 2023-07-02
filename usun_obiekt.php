<?php


session_start();
if (ISSET($_SESSION['logged']) and $_SESSION['logged'] == true) {
    $_SESSION['error'] = "";
} else {
    header("Location: /logowanie.php");
    exit();
}


require "./DBconfig.php";


    $id = $_POST['id'] ?? null;
    $dbname = $_POST['dbname'] ?? null;
    $stronabool = $_POST['stronabool'] ?? null;
    $uslugabool = $_POST['uslugabool'] ?? null;

    if ($stronabool) {
        $sql = "SELECT `nav` FROM $dbname WHERE ID = :ID";
        try {
            $zapytanie = $pdo->prepare($sql);
            $zapytanie->execute(array(':ID' => $id));
            $result = $zapytanie->fetch(); // pobierz wynik zapytania
            $filename = 'nowestrony/'.$result['nav'].'.php'; // przypisz wartość z kolumny `nav` do zmiennej
            unlink($filename);
        } catch (PDOException $e) {
            echo("Wystąpił błąd podczas usuwania strony: " . $e->getMessage());
                      
        }
    }
    if ($uslugabool) {
        $sql = "SELECT `tytul` FROM $dbname WHERE ID = :ID";
        try {
            $zapytanie = $pdo->prepare($sql);
            $zapytanie->execute(array(':ID' => $id));
            $result = $zapytanie->fetch(); // pobierz wynik zapytania
            $filename = 'noweuslugi/'.$result['tytul'].'.php'; // przypisz wartość z kolumny `nav` do zmiennej
            unlink($filename);
        } catch (PDOException $e) {
            echo("Wystąpił błąd podczas usuwania strony: " . $e->getMessage());
                      
        }
    }
  

    
    
    if ($id !== null && $dbname !== null) {
                $sql = "DELETE FROM " . $dbname . " WHERE ID=:ID";
                try {
                    $zapytanie = $pdo->prepare($sql);
                    $zapytanie->execute(array(':ID' => $id));
                    
                } catch (PDOException $e) {
                    echo("Wystąpił błąd podczas dodawania opini: " . $e->getMessage());
                    exit();
                }
    } else {
        echo "Błąd: Brak danych w żądaniu POST.";
        exit();
    }
    $pdo = null;
?>
