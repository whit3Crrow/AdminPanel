<?php
session_start();
if (ISSET($_SESSION['logged']) && $_SESSION['logged'] == true) {
    $_SESSION['error'] = "";
} else {
    header("Location: /logowanie.php");
    exit();
}

// Sprawdzenie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES["baner"])) {
        // Przesłanie pliku do folderu /uploads
        $target_dir = "uploads/";
        $target_file1 = $target_dir . basename($_FILES["baner"]["name"]);
        $uploadOk1 = 1;
        $imageFileType = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

        if ($imageFileType == '') {
            $uploadOk1 = 0;
        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
            $_SESSION['error2'] = "Nie dodałem usługi, W banerze dozwolone są tylko pliki JPG, JPEG, PNG i WEBP.{$imageFileType}";
            $target_file1 = null;
            header("Location: /adminpanel.php");
            exit();
        }
    }

    // Sprawdzenie, czy plik został przesłany
    if (isset($_FILES["image"])) {
        // Przesłanie pliku do folderu /uploads
        $target_dir = "uploads/";
        $target_file2 = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

        // Sprawdzenie formatu pliku
        if ($imageFileType == '') {
            $_SESSION['error2'] = "Nie dodano usługi, ponieważ nie została przesłana miniatura";
            $uploadOk = 0;
            header("Location: /adminpanel.php");
            exit();
        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
            $_SESSION['error2'] = "Nie dodałem usługi, W miniaturze dozwolone są tylko pliki JPG, JPEG, PNG i WEBP.{$imageFileType}";
            $target_file2 = null;
            header("Location: /adminpanel.php");
            exit();
        }

        // Przesłanie pliku, jeśli wszystko jest w porządku
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file2)) {
            }
            else {
                $_SESSION['error2'] = "Wystąpił błąd podczas przesyłania pliku.";
                header("Location: /adminpanel.php");
                exit();
                }
                }    if ($uploadOk1 == 1) {
                    if (move_uploaded_file($_FILES["baner"]["tmp_name"], $target_file1)) {
                    } else {
                        $_SESSION['error2'] = "Wystąpił błąd podczas przesyłania pliku.";
                        header("Location: /adminpanel.php");
                        exit();
                    }
                }
            } else {
                $_SESSION['error2'] = "Nie przesłano żadnego pliku.";
                $target_file1 = null;
                $target_file2 = null;
                header("Location: /adminpanel.php");
                exit();
            }
            
            require_once('DBconfig.php');
            $html = $_POST['quill-content'];
            $tytuł = $_POST['title'];
            $opis = $_POST['summary'];
            $miniatura = $_FILES['image']['name'];
            
            if ($uploadOk1 == 1) {
                $baner = $_FILES['baner']['name'];
            } else {
                $baner = 'domyslnybaner107.png';
            }
            $html = str_replace('<img class="img-fluid" src="', '<img class="img-fluid" src="../', $html);
            if (trim($html) == "" or trim($opis) == "" or trim($tytuł) == "") {
            
                $_SESSION['error2'] = "pola tekstowe nie mogą mogą pozostać puste";
                header("Location: /adminpanel.php");
                exit();
            }
            
            if ($uploadOk == 1) {
            
                try {
                    $zapytanie = $pdo->prepare("INSERT INTO `usługi`(`html`, `tytul`, `opis`, `miniatura`,`baner`) VALUES (:html, :tytul, :opis, :miniatura, :baner)");
                    $zapytanie->execute(array(':html' => $html, ':tytul' => $tytuł, ':opis' => $opis, ':miniatura' => $miniatura, ':baner' => $baner));
                    $template = file_get_contents('szablonuslugi.php');
                    $template = str_replace('{tytul}', $tytuł, $template);
                    $template = str_replace('{content}', $html, $template);
                    $template = str_replace('{baner}', $baner, $template);
                    $filename = 'noweuslugi/' . $tytuł . '.php';
                    $file = fopen($filename, 'w');
                    fwrite($file, $template);
                    $_SESSION['success'] = "Dodano usługę !";
                    header("Location: /adminpanel.php");
                } catch (PDOException $e) {
                    $_SESSION['error2'] = "Wystąpił błąd podczas dodawania usługi: " . $e->getMessage();
                    header("Location: /adminpanel.php");
                    exit();
                }
            }
        }            