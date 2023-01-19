//On établit les constantes des éléments nécessaires.
      //On récupère les éléments avc les élément de classe voulus.
const indicator = document.querySelector(".indicator-verif"),
      iconText = document.querySelector(".icon-text"),
      text = document.querySelector(".text"),
      //On réucupere les elemtens avec l'id voulus.
      eye1 = document.getElementById("eye1"),
      eye2 = document.getElementById("eye2"),
      eye3 = document.getElementById("eye3"),
      input_mdp1 = document.getElementById("register-password"),
      input_mdp2 = document.getElementById("register-password-2"),
      input_mdp3 = document.getElementById("register-old-password");

//Dès qu'on clique sur un oeil
eye1.addEventListener("click", ()=>{
  //Si il est de type "password"
  if(input_mdp1.type == "password"){
    //on définit le type en texte pour voir le mot de passe
    input_mdp1.type = "text";
    //on affiche l'oeil en non barré
    eye1.classList.replace("fa-eye-slash","fa-eye");
  }else{
    input_mdp1.type = "password";
    //on affiche l'oeil en barré
    eye1.classList.replace("fa-eye","fa-eye-slash");
  }
});
eye2.addEventListener("click", ()=>{
  //Si il est de "password"
  if(input_mdp2.type == "password"){
    //on définit le type en texte pour voir le mot de passe
    input_mdp2.type = "text";
    //on affiche l'oeil en non barré
    eye2.classList.replace("fa-eye-slash","fa-eye");
  }else{
    input_mdp2.type = "password";
    //on affiche l'oeil en barré
    eye2.classList.replace("fa-eye","fa-eye-slash");
  }
});
//Si l'on est dans inscription.php, on n'y tien pas compte,
//si on veut modifier son mot de passe, on y tiens compte.
if (eye3){
  eye3.addEventListener("click", ()=>{
    //Si il est de "password"
    if(input_mdp3.type == "password"){
      //on définit le type en texte pour voir le mot de passe
      input_mdp3.type = "text";
      //on affiche l'oeil en non barré
      eye3.classList.replace("fa-eye-slash","fa-eye");
    }else{
      input_mdp3.type = "password";
      //on affiche l'oeil en barré
      eye3.classList.replace("fa-eye","fa-eye-slash");
    }
  })
};

//On définis les critères des mots de passe.
    //Toutes les lettres de a à z y compis les majuscules.
let alphabet = /[a-zA-Z]/,
    //Tous les chiffres de 0 à 9.
    numbers = /[0-9]/,
    //Touts les caractères "spéciaux".
    scharacters = /[!,@,#,$,%,^,&,*,?,_,(,),-,+,=,~]/;
//Si l'on écris dans le champs
input_mdp1.addEventListener("keyup", ()=>{
  //On ajoute la propriété de classe "active".
  indicator.classList.add("active");

  //On définis la valeur de l'imput dans une constante.
  let val = input_mdp1.value;
  //Si la valeur contient aumois une lettre ou un chiffre ou un caractère
  if(val.match(alphabet) || val.match(numbers) || val.match(scharacters)){
    //On indique la force du mot de passe 
    text.textContent = "Mot de passe faible";
    //On change la courleur de la bordure (rouge)
    input_mdp1.style.borderColor = "#FF6333";
    //On change la courleur de l'oeil (rouge)
    eye1.style.color = "#FF6333";
    //On change la couleur du texte (rouge)
    iconText.style.color = "#FF6333";
  }
  //Si la valeur contient, une lettre, un chiffre, 6 au moins caractère au total
  if(val.match(alphabet) && val.match(numbers) && val.length >= 6){
    //On indique la force du mot de passe 
    text.textContent = "Mot de passe moyen";
    //On change la courleur de la bordure (orange)
    input_mdp1.style.borderColor = "#cc8500";
    //On change la courleur de l'oeil (orange)
    eye1.style.color = "#cc8500";
    //On change la couleur du texte (orange)
    iconText.style.color = "#cc8500";
  }
  //Si la valeur contient, une lettre, un chiffre, un caractère spécial et au moins 6 caractère au total
  if(val.match(alphabet) && val.match(numbers) && val.match(scharacters) && val.length >= 8){
    //On indique la force du mot de passe 
    text.textContent = "Mot de passe fort";
    //On change la courleur de la bordure (vert)
    input_mdp1.style.borderColor = "#22C32A";
    //On change la courleur de l'oeil (vert)
    eye1.style.color = "#22C32A";
    //On change la couleur du texte (vert)
    iconText.style.color = "#22C32A";
  }
  //Si la valeur de l'input est vide
  if(val == ""){
    //On enleve "active" de l'attibus "class"
    indicator.classList.remove("active");
    //On change la courleur de la bordure (girs)
    input_mdp1.style.borderColor = "#A6A6A6";
    //On change la courleur de l'oeil (girs)
    eye1.style.color = "#A6A6A6";
    //On change la couleur du texte (girs)
    iconText.style.color = "#A6A6A6";
  }
});