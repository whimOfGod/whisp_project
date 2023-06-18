function openMenu(){
    document.getElementById("open_menu").classList.add("d-none");
    document.getElementById("menu_items").classList.remove("d-none");
    document.getElementById("menu_items").classList.add("d-inline-block");
    document.getElementById("menu_items").classList.add("open");
    
    document.getElementById("menu").classList.remove("d-flex");
    document.getElementById("menu").classList.add("d-none");
}
function closeMenu(){
    document.getElementById("open_menu").classList.remove("d-none");
    document.getElementById("menu_items").classList.add("d-none");
    document.getElementById("menu_items").classList.remove("open");
    document.getElementById("menu_items").classList.remove("d-inline-block");

    document.getElementById("menu").classList.add("d-flex");
    document.getElementById("menu").classList.remove("d-none");
}
function imageFile() {
    document.getElementById("image").classList.remove("d-none");           
}

function showTag() {
    document.getElementById("tag").classList.remove("d-none");           
}

// Gestion de la connexion
function openSignUp(){
    document.getElementById("sign_in").classList.remove("d-flex");
    document.getElementById("sign_in").classList.add("d-none");           
    document.getElementById("sign_up").classList.remove("d-none")
}

function openSignIn(){
    document.getElementById("sign_up").classList.add("d-none");
    
    document.getElementById("sign_in").classList.remove("d-none")
}

//ajoute une fonction qui permet de fermer la fenêtre de connexion
function closeSignIn(){
document.getElementById("hoverSection").classList.add("d-none");
}