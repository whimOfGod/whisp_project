<nav class="bg-primary text-white p-2 d-none" aria-label="Menu Item" id="menu_items">
  <!-- Close menu icon -->
  <figure onclick="closeMenu()" class="cursor-pointer">
    <img src="images/close.svg" title="Fermer le menu" alt="Fermer" class="w-20" />
  </figure>
  <ul class="list-unstyled px-4 text-decoration-none">
    <li class="cursor-pointer">Accueil</li>
    <li class="cursor-pointer">Profil</li>
    <li class="cursor-pointer">A propos</li>
    <li class="cursor-pointer">Confidentialité</li>
    <li class="cursor-pointer"><a class="text-white text-decoration-none " onclick="showForm()">connectez-vous ?</a></li>
    <li class="cursor-pointer"><a class="text-white text-decoration-none" href="template/disconnect.php">disconnect </a></li>
    <li class="cursor-pointer" onclick="showForm()">S'inscrire</li>
    <?php if (isset($_SESSION['s_users_id'])) { ?>
      <div class="user-avatar rounded-3 border-2 border-primary no-outline">
        <?php if (!empty($_SESSION['s_avatar']) && file_exists('images/avatar/' . $_SESSION['s_avatar'])) { ?>
          <img src="images/avatar/<?php echo $_SESSION['s_avatar']; ?>" width="50" alt="Avatar">
        <?php } else { ?>
          <img src="images/avatar/default-avatar.png"
               class="avatarIcon"
               width="50" alt="Avatar">
        <?php } ?>
      </div>
    <?php } ?>
  </ul>
  <script>
    // fonction qui enlève la classe d-none à l'id hoverSection 
    function showForm() {
      document.getElementById('hoverSection').classList.remove('d-none');
    }
  </script>
</nav>