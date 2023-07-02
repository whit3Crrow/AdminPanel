// Pobierz wszystkie elementy nawigacji
var navLinks = document.querySelectorAll('ul a li');
const nav = document.querySelector(".navbar ul");


// Dodaj nasłuchiwanie kliknięcia na każdym elemencie nawigacji
navLinks.forEach(function(navLink) {
  navLink.addEventListener('click', function() {
    // Usuń klasę "active" z wszystkich elementów nawigacji
    navLinks.forEach(function(navLink) {
      navLink.classList.remove('aktywny');
      
    });
    if(nav.classList.contains("sq")){
        nav.classList.remove('sq');
    }
    // Dodaj klasę "active" do klikniętego elementu nawigacji
    setTimeout(() => {
        this.classList.add('aktywny');
    }, 500);

    
    
  });
});

const guzik = document.querySelector(".trzykreski");


guzik.onclick = function(){
    nav.classList.toggle("sq");
}