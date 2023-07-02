<?php
$target_dir = "uploads/";

if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Plik " . basename($_FILES["image"]["name"]) . " został przesłany.";
    } else {
        echo "Przepraszamy, wystąpił błąd podczas przesyłania pliku.";
    }
} else {
    echo "Przepraszamy, wystąpił błąd podczas przesyłania pliku.";
}
?>
