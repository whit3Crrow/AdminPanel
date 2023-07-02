
<?php
// Prosta implementacja dla demonstracji
if (isset($_FILES['image'])) {
    $filename = basename($_FILES['image']['name']);
    $target = 'uploads/' . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo json_encode(['imageUrl' => $target]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Błąd podczas przesyłania pliku.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Brak pliku do przesłania.']);
}
?>
