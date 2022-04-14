<?php
require_once("INCLUDES/config.php");
if ($_SESSION["session_start"]) {


    require_once("INCLUDES/head.php");
    require_once("INCLUDES/header.php");

?>



    <main class="flex center row " style="align-items: flex-start;">

        <section>
          


        </section>



       

        <?php
        /*Ce fichier contient le modal qui nous permet de crée un post*/
        require_once("createPostModal.php"); ?>
    </main>

    </body>
    <script src="JS/allfollowing.js" defer></script>
    

    </html>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<?php
} else {
    header("Location:connexion.php?erreur=4");
}
?>