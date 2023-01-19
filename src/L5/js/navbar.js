//On attend le chargement du DOM
document.addEventListener('DOMContentLoaded', function () {
	//On récupere le bouton "burger"
    const menuHamburger = document.getElementById("nav-burger");
    //On récupere les boutons de navigation
    const navLinks = document.getElementById("nav-items");
    //Si les deux boutons sont trouvé
    if (menuHamburger && navLinks){
    	//Dès qu'un clique est repéré
        menuHamburger.addEventListener('click',()=>{
        	//On ajoute la classe "mobile-menu" a notre liste de boutons
            navLinks.classList.toggle('mobile-menu');
        });
    }
});