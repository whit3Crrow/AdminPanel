<?php 
    session_start();
    if(ISSET($_SESSION['logged']) and $_SESSION['logged']==true){
        $_SESSION['error']="";

    }
    else {
        header("Location: /logowanie.php");  
        exit();      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Stronę</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="/admin-style.css">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>
    <header class="d-flex justify-content-center bg-dark text-white-50 p-2 display-1">Dodawanie Strony</header>
    <div class="m-4"></div>
    <div class="container justify-content-center align-content-center">
        <a href="index.php" target="blank"><div class=" btn btn-outline-primary m-2 shadow2 myboxshadow" id="zobacz_strone">Zobacz stronę</div></a>
        <a href="adminpanel.php"><div class="btn btn-outline-primary myboxshadow m-2 shadow2" id="wyloguj"> Panel główny</div></a>
    </div>
    <div class="container myboxshadow rounded-3 border my-4 p-3">
        <form class="d-flex flex-column" action="send_strona.php" method="POST">
            <label class="lead fs-3">Tytuł Strony w Nawigacji</label>
            <input class="m-2 border" placeholder="Skrót" name='nav'></input>
            <label class="lead fs-3">Nagłówek (wstęp)</label>
            <input class="m-2 border" placeholder="Nagłówek" name='tytul'></input>
            <label class="lead fs-3">Treść</label>
            <div id="quill-editor" class="m-2 border"></div>           
            <input type="hidden" name="quill-content" id="quill-content">     
            <a href="adminpanel.php"><div class="btn btn-outline-danger myboxshadow my-2 p-2  w-100">Anuluj</div></a>
            <button type="submit" class="btn btn-outline-success myboxshadow p-2 w-100">Dodaj Stronę</button>
        </form>
</body>
<script>

const toolbarOptions = [
  // inne opcje paska narzędzi
  ["bold", "italic", "underline", "strike"],['link'],


  [{ "header": 1 }, { "header": 2 }],
  [{ "list": "ordered"}, { "list": "bullet" }],
  [{ "script": "sub"}, { "script": "super" }],
  [{ "indent": "-1"}, { "indent": "+1" }],
  [{ "direction": "rtl" }],

  [{ "size": ["small", false, "large", "huge"] }],
  [{ "header": [1, 2, 3, 4, 5, 6, false] }],

  [{ "color": [] }, { "background": [] }],
  [{ "font": [] }],
  [{ "align": [] }],

  ["image"], // opcja obrazu na pasku narzędzi
];

const quill = new Quill("#quill-editor", {
  modules: {
    toolbar: {
        container: toolbarOptions,
        handlers: {
          image: imageHandler
        },
    },
  },
  theme: "snow",
});

function imageHandler() {
  const input = document.createElement("input");
  input.setAttribute("type", "file");
  input.setAttribute("accept", "image/*");
  input.click();

  input.addEventListener("change", () => {
    const file = input.files[0];
    if (file) {
      // Wysyłanie pliku do serwera
      const formData = new FormData();
      formData.append("image", file);

      fetch("upload_image.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Błąd podczas przesyłania pliku");
          }
          return response.text();
        })
        .then(() => {
          // Wstawianie obrazu do edytora
          const img = `<img class="img-fluid" src="uploads/${file.name}"></img>`;
          quill.root.innerHTML += img;

          // Ustawienie kursora na ostatni znak aktualnego tekstu plus długość wstawionego obrazu
          const currentRange = quill.getSelection();
          if (currentRange) {
            const index = currentRange.index + currentRange.length + img.length;
            quill.setSelection(index);
          } else {
            quill.setSelection(img.length);
          }

          console.log(quill.root.innerHTML);
        })
        .catch((error) => {
          console.error("Błąd podczas przesyłania pliku: ", error);
        });
    }
  });
}


  const form = document.querySelector("form");
  const quillContentInput = document.querySelector("#quill-content");

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    // pobranie zawartości edytora
    const editorContent = quill.getContents();

    // konwersja zawartości do formatu HTML
    const htmlContent = quill.root.innerHTML;

    // konwersja zawartości do formatu JSON
    const jsonContent = JSON.stringify(editorContent);
    console.log(editorContent);
    console.log(htmlContent);
    console.log(jsonContent);
    quillContentInput.value = htmlContent; 
    form.submit();    
  });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>