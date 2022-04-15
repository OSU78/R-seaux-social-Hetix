<?php
require_once("INCLUDES/config.php");
if ($_SESSION["session_start"]) {


    require_once("INCLUDES/head.php");
    require_once("INCLUDES/header.php");
    require_once("API/getUserInfo.php");

    // print_r($userInfo);

?>
    <style>
        .textarea::placeholder {
            color: #495952bf
        }

        .textarea {
            font-size: 20px
        }

        .inputText2 svg:hover {
            fill: #58ca9a26
        }
    </style>

    <main class="flex center row " style="display: flex;height: 90vh;align-items: flex-start;align-items: center;">

        <section>

            <section>
                <li class='flex center row center maxWidth cursorNone spaceBetween card customCard'>
                    <div class='flex flexStartJ' style="align-items: center;">
                        <img class='circle_span' src='ASSETS/profilPicture/<?= $userInfo[0]["imageProfil"]; ?>' alt='' width='35px'>
                        <div class='flex center'>
                            <?php

                            if ($userInfo[0]["userVerifier"] == 1) {
                            ?>
                                <p idUser='' style='font-weight: 200;font-size: 18px;' class='colorBlackGray suggestItem'><?= $userInfo[0]["pseudo"]; ?></p>
                                <svg width="20" height="20" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.6844 2.39249C26.9441 1.63497 26.06 1.03305 25.0838 0.622101C24.1077 0.211147 23.0592 -0.000549316 22.0001 -0.000549316C20.941 -0.000549316 19.8925 0.211147 18.9164 0.622101C17.9402 1.03305 17.0561 1.63497 16.3159 2.39249L14.6054 4.14699L12.1579 4.11674C11.0984 4.1042 10.0472 4.30362 9.06592 4.70328C8.08468 5.10294 7.19326 5.69476 6.44407 6.44395C5.69488 7.19314 5.10306 8.08456 4.7034 9.06581C4.30374 10.047 4.10432 11.0983 4.11686 12.1577L4.14436 14.6052L2.39536 16.3157C1.63784 17.056 1.03592 17.9401 0.624969 18.9163C0.214016 19.8924 0.00231934 20.9409 0.00231934 22C0.00231934 23.0591 0.214016 24.1076 0.624969 25.0837C1.03592 26.0599 1.63784 26.944 2.39536 27.6842L4.14711 29.3947L4.11686 31.8422C4.10432 32.9017 4.30374 33.9529 4.7034 34.9342C5.10306 35.9154 5.69488 36.8068 6.44407 37.556C7.19326 38.3052 8.08468 38.897 9.06592 39.2967C10.0472 39.6964 11.0984 39.8958 12.1579 39.8832L14.6054 39.8557L16.3159 41.6047C17.0561 42.3622 17.9402 42.9642 18.9164 43.3751C19.8925 43.7861 20.941 43.9978 22.0001 43.9978C23.0592 43.9978 24.1077 43.7861 25.0838 43.3751C26.06 42.9642 26.9441 42.3622 27.6844 41.6047L29.3949 39.853L31.8424 39.8832C32.9018 39.8958 33.953 39.6964 34.9343 39.2967C35.9155 38.897 36.8069 38.3052 37.5561 37.556C38.3053 36.8068 38.8971 35.9154 39.2968 34.9342C39.6965 33.9529 39.8959 32.9017 39.8833 31.8422L39.8558 29.3947L41.6048 27.6842C42.3624 26.944 42.9643 26.0599 43.3752 25.0837C43.7862 24.1076 43.9979 23.0591 43.9979 22C43.9979 20.9409 43.7862 19.8924 43.3752 18.9163C42.9643 17.9401 42.3624 17.056 41.6048 16.3157L39.8531 14.6052L39.8833 12.1577C39.8959 11.0983 39.6965 10.047 39.2968 9.06581C38.8971 8.08456 38.3053 7.19314 37.5561 6.44395C36.8069 5.69476 35.9155 5.10294 34.9343 4.70328C33.953 4.30362 32.9018 4.1042 31.8424 4.11674L29.3949 4.14424L27.6844 2.39524V2.39249ZM28.4736 18.8485L20.2236 27.0985C20.0959 27.2265 19.9441 27.3281 19.7771 27.3974C19.61 27.4668 19.431 27.5024 19.2501 27.5024C19.0692 27.5024 18.8902 27.4668 18.7231 27.3974C18.5561 27.3281 18.4043 27.2265 18.2766 27.0985L14.1516 22.9735C14.0238 22.8456 13.9224 22.6939 13.8532 22.5268C13.784 22.3598 13.7484 22.1808 13.7484 22C13.7484 21.8192 13.784 21.6402 13.8532 21.4731C13.9224 21.3061 14.0238 21.1543 14.1516 21.0265C14.2794 20.8986 14.4312 20.7972 14.5982 20.728C14.7653 20.6589 14.9443 20.6232 15.1251 20.6232C15.3059 20.6232 15.4849 20.6589 15.652 20.728C15.819 20.7972 15.9708 20.8986 16.0986 21.0265L19.2501 24.1807L26.5266 16.9015C26.7848 16.6433 27.135 16.4982 27.5001 16.4982C27.8652 16.4982 28.2154 16.6433 28.4736 16.9015C28.7318 17.1597 28.8768 17.5099 28.8768 17.875C28.8768 18.2401 28.7318 18.5903 28.4736 18.8485V18.8485Z" fill="#58CA9A" />
                                </svg>
                            <?php
                            } else {
                            ?>
                                <p idUser='' style='font-weight: 200;font-size: 18px;' class='colorBlackGray suggestItem'><?= $userInfo[0]["pseudo"]; ?></p>

                            <?php
                            }

                            ?>
                        </div>
                    </div>
                    <div class='flex center row'> </div>
                </li>
            </section>
            <section class='flex card columns cursorNone customCard'>
                <div id="allMessage" class='flex columns cursorNone'>
                    <div id="data" class="flex center">
                        <lottie-player id="lottie" src="ASSETS/icones/loadingHetix.json" background="transparent" speed="1" style="width: 50px; height: 50px;position: absolute;top: 25%;" loop autoplay></lottie-player>
                    </div>

                </div>
                <hr class="customHr2">
                <div class="inputText2 flex center">
                    <textarea class="styleNone textarea" name="messageContent" id="messageContent" cols="5" rows="2" placeholder="😀 Dite coucou à <?= $userInfo[0]["pseudo"]; ?> !"></textarea>
                    <div id="sendMsg" class="sendStyle" style="right: 22px;position: absolute;width: 45px;right: 2px;top: 7px;">
                        <svg width="26" height="26" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.5 21H21M8.5 21L2.25 39.75L39.75 21L2.25 2.25L8.5 21Z" stroke="#58CA9A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>


                </div>
            </section>


        </section>

        <?php
        /*Ce fichier contient le modal qui nous permet de crée un post*/
        require_once("createPostModal.php"); ?>
    </main>

    </body>
    <script src="JS/urlParam.js"></script>
    <script src="JS/message.js"></script>
    <script src="JS/autoResizeText.js"></script>

    <script src="JS/headerInteract.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="JS/frontInteraction.js" defer></script>
    <script src="JS/createNewPost.js" defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    </html>

<?php
} else {
    header("Location:connexion.php?erreur=4");
}
?>