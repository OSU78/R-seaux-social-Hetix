<?php
require_once("INCLUDES/config.php");
if ($_SESSION["session_start"]) {


    require_once("INCLUDES/head.php");
    require_once("INCLUDES/header.php");

?>



    <main class="flex center row " style="align-items: flex-start;">

        <section>
            <style>
                .story {
                    min-height: 50px;
                    min-width: 50px;
                    border-radius: 100px;
                    cursor: pointer;
                    background-image: url("ASSETS/profilPicture/defaultProfil.jpg");
                    background-size: cover;
                    background-repeat: no-repeat;


                }

                .newstory {

                    border: 3px solid #49ca9f
                }

                .storyDiv {
                    overflow-x: auto;
                    overflow-y: hidden;
                    white-space: nowrap;
                    max-width: 508px;

                }

                #helloMessage {
                    font-weight: 100;
                    font-size: 22px;
                    color: rgb(0 0 0 / 53%);
                    
                }
                #helloMessage p{
                    text-decoration: underline;
                    color: #58ca9a;
                }
            </style>

            <div class="storyDiv flex row paddingLR10 gap20 mgTop18" style="padding-bottom: 0px;">
                <h1 class="flex center row" id="helloMessage">Bon retour parmit nous <p><?=$_SESSION["pseudo"];?></p> </h1>
            </div>

            <div id="onepost">
                <div class="flex center">
                    <lottie-player id="lottieForPost" src="ASSETS/icones/loadingHetix.json" background="transparent" speed="1" style="width: 50px; height: 50px;position: absolute;top: 25%;" loop autoplay></lottie-player>
                </div>
            </div>



        </section>



        <section class="card fixed cursorNone" style="z-index: 8;">
            <div class=" flex row center spaceArround">
                <div class="flex row spaceBetween center">
                    <p>Suggestions pour vous</p><a href="#" class="links">Voir tout</a>
                </div>
            </div>
            <hr class="customHr">
            <div id="data" class="flex center">
                <lottie-player id="lottie" src="ASSETS/icones/loadingHetix.json" background="transparent" speed="1" style="width: 50px; height: 50px;position: absolute;top: 25%;" loop autoplay></lottie-player>
            </div>


            <div id="suggestion">

            </div>

        </section>

        <?php
        /*Ce fichier contient le modal qui nous permet de crée un post*/
        require_once("createPostModal.php"); ?>
    </main>

    </body>
    <script src="JS/follow.js" defer></script>
    <script src="JS/headerInteract.js" defer></script>
    <script src="JS/ajax.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="JS/urlParam.js" defer></script>
    <script src="JS/notificationPush.js" defer></script>
    <script src="JS/frontInteraction.js" defer></script>
    <script src="JS/createNewPost.js" defer></script>
    <script src="JS/allPost.js" defer></script>

    </html>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<?php
} else {
    header("Location:connexion.php?erreur=4");
}
?>