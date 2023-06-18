
<section class="bg-black-transparent position-fixed top-0 w-100 h-100
                d-flex align-items-center justify-content-center"
                id="hoverSection">

                <!-- un bouton pour fermer la section -->
                <button class="btn bg-danger position-absolute top-0 end-0" onclick="closeSignIn()">X</button> 
    <div>
        <!-- Login form -->
        <div id="sign_in" class="rounded-3 bg-white border border-info p-5 h-full">
            <form   class="d-flex flex-column" method="POST" action="template/login_back.php"
                    enctype="multipart/form-data">
                <h2 class="fw-bold fs-3"> S'AUTHENTIFIÉ </h2>
                <input class="my-3 p-1 rounded-3 border-2 border-primary no-outline" type="email"
                        name="mail" placeholder="Email" 
                        autocomplete="off"
                        required />
                <input  class="p-1 rounded-3 border-2 border-primary no-outline" type="password"
                        name="password" placeholder="Mot de passe" required>
                <input type="submit" value="connexion" class="my-3 bg-primary py-1 text-white border-0 rounded-3" />
            </form>
            <!-- Need help ? -->
            <p class="mb-0 ">
                si vous n'avez pas de compte
                <button type="button" class="text-primary border-0 bg-transparent"
                        onclick="openSignUp()">
                        inscrivez-vous
                </button>
            </p>
        </div>
        <!-- SIGN UP form -->
        <div id="sign_up" class="d-none rounded-3 bg-white border border-info p-5 h-full">
            <form   class="d-flex flex-column" method="POST" action="template/registered.php"
                    enctype="multipart/form-data">
                <h2 class="fw-bold fs-3"> S'INSCRIRE </h2>
                <input  class="my-3 p-1 rounded-3 border-2 border-primary no-outline" type="text"
                        name ="nom"
                        placeholder="Nom & Prénoms" />
                <input  class="p-1 rounded-3 border-2 border-primary no-outline" type="text"
                        name ="pseudo"
                        placeholder="Pseudo">
                <input  class="my-3 p-1 rounded-3 border-2 border-primary no-outline" type="email"
                        name="mail" placeholder="Email">
                <input  class="my-3 p-1 rounded-3 border-2 border-primary no-outline" type="file"
                        name="avatar" id="avatar">
                <input  class="p-1 rounded-3 border-2 border-primary no-outline" type="password"
                        name = "my_password"
                        placeholder="Mot de passe"
                        max="20" min="0">
                <input type="submit" value="inscription" class="my-3 bg-primary py-1 text-white border-0 rounded-3" />
            </form>
            <!-- Need help ? -->
            <p class="mb-0 ">
                Vous avez déjà un compte ?
                <button type="submit" class="text-primary border-0 bg-transparent" onclick="openSignIn()">
                     Connectez-vous
                </button>
            </p>
        </div>
    </div>
    <script src="js/script.js"></script>
</section>