<?php
require_once("INCLUDES/config.php");
if ($_SESSION["session_start"]) {


    require_once("INCLUDES/head.php");
    require_once("INCLUDES/header.php");

    if (isset($_GET["id"])) {


        $idU = htmlspecialchars($_GET["id"]);
        $allPost = $bdd->prepare('SELECT * FROM post INNER JOIN user u ON u.id = post.id_user where u.id=? ORDER BY id_post DESC;');


        //var_dump($allPost);
        $allPost->execute(array($idU));
        $arrayAllPost = $allPost->fetchAll();
        $toto = array("tptp", "ezez");
        //print_r(sizeOf($arrayAllPost));

        if (sizeOf($arrayAllPost) <= 40) {
            $allPost = $bdd->prepare('SELECT * FROM post RIGHT JOIN user u ON u.id = post.id_user where u.id=? ORDER BY id_post DESC;');
            $allPost->execute(array($idU));
        }
        //    print_r($allPost->fetchAll());
        //     die();
        // //print_r($email);
        // //print_r($mdpsec);
        $arrayAllPost = array();


        /*On verifie si la personne est abonnée ou pas */
        $req_ifFollow = $bdd->prepare('SELECT * FROM FOLLOW WHERE id_suiveur=? and id_suivi=?;');
        //var_dump($allPost);
        $req_ifFollow->execute(array($_SESSION["id"], $idU));
        if (sizeOf($req_ifFollow->fetchAll()) > 0) {
            $isFollow = true;
        } else {
            $isFollow = false;
        }

        // echo($isFollow);
        // die();

        while ($row = $allPost->fetchAll()) {



            /*On recupere le nombre de like de chaque post*/
            for ($i = 0; $i < sizeof($row); $i++) {
                $postLike = $bdd->prepare('SELECT COUNT(id_like) FROM likecounter where id_post=?;');
                $postLike->execute(array($row[$i]["id_post"]));
                $CountLike = $postLike->fetch()[0];
                $row[$i]["likeTotal"] = $CountLike;

                /*On recupère le nombre total des commentaires*/
                $postComment = $bdd->prepare('SELECT COUNT(*) FROM commentaire where id_post=?;');
                $postComment->execute(array($row[$i]["id_post"]));
                $countComment = $postComment->fetch()[0];
                $row[$i]["comTotal"] = $countComment;
            }

            //print_r($row[0]);
            //die();

            $arrayAllPost[] = $row;
            //print_r($row[0]);
            // die();
        }

        // print_r($arrayAllPost[0][0]["imageProfil"]);
        // die();

?>


        <style>
            .circleProfilImg {
                background-image: url("ASSETS/profilPicture/<?= $arrayAllPost[0][0]['imageProfil'] ?>");
                border-radius: 200px;
                width: 150px;
                height: 150px;
                background-size: cover;
            }

        </style>
        <main class="flex center row mgTop40 " style="align-items: flex-start;">
            <?php
            /*Ce fichier contient le modal qui nous permet de crée un post*/
            require_once("createPostModal.php"); ?>
            <section class=" flex center columns max500 mg10" style="align-items: flex-start;">
                <section class="flex center row gap50">

                    <section class="circleProfilImg">

                    </section>
                    <section class="flex columns alignItemStart ">
                        <div class="flex gap20 row spaceBetween alignItemCenter maxWidth2 cursorNone">
                            <div class="flex row gap10 center">
                                <p class="userPseudo"><?= $arrayAllPost[0][0]["pseudo"]; ?> </p>
                                <?php
                                if ($arrayAllPost[0][0]["userVerifier"]) {
                                ?>
                                    <svg width="20" height="20" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.6844 2.39249C26.9441 1.63497 26.06 1.03305 25.0838 0.622101C24.1077 0.211147 23.0592 -0.000549316 22.0001 -0.000549316C20.941 -0.000549316 19.8925 0.211147 18.9164 0.622101C17.9402 1.03305 17.0561 1.63497 16.3159 2.39249L14.6054 4.14699L12.1579 4.11674C11.0984 4.1042 10.0472 4.30362 9.06592 4.70328C8.08468 5.10294 7.19326 5.69476 6.44407 6.44395C5.69488 7.19314 5.10306 8.08456 4.7034 9.06581C4.30374 10.047 4.10432 11.0983 4.11686 12.1577L4.14436 14.6052L2.39536 16.3157C1.63784 17.056 1.03592 17.9401 0.624969 18.9163C0.214016 19.8924 0.00231934 20.9409 0.00231934 22C0.00231934 23.0591 0.214016 24.1076 0.624969 25.0837C1.03592 26.0599 1.63784 26.944 2.39536 27.6842L4.14711 29.3947L4.11686 31.8422C4.10432 32.9017 4.30374 33.9529 4.7034 34.9342C5.10306 35.9154 5.69488 36.8068 6.44407 37.556C7.19326 38.3052 8.08468 38.897 9.06592 39.2967C10.0472 39.6964 11.0984 39.8958 12.1579 39.8832L14.6054 39.8557L16.3159 41.6047C17.0561 42.3622 17.9402 42.9642 18.9164 43.3751C19.8925 43.7861 20.941 43.9978 22.0001 43.9978C23.0592 43.9978 24.1077 43.7861 25.0838 43.3751C26.06 42.9642 26.9441 42.3622 27.6844 41.6047L29.3949 39.853L31.8424 39.8832C32.9018 39.8958 33.953 39.6964 34.9343 39.2967C35.9155 38.897 36.8069 38.3052 37.5561 37.556C38.3053 36.8068 38.8971 35.9154 39.2968 34.9342C39.6965 33.9529 39.8959 32.9017 39.8833 31.8422L39.8558 29.3947L41.6048 27.6842C42.3624 26.944 42.9643 26.0599 43.3752 25.0837C43.7862 24.1076 43.9979 23.0591 43.9979 22C43.9979 20.9409 43.7862 19.8924 43.3752 18.9163C42.9643 17.9401 42.3624 17.056 41.6048 16.3157L39.8531 14.6052L39.8833 12.1577C39.8959 11.0983 39.6965 10.047 39.2968 9.06581C38.8971 8.08456 38.3053 7.19314 37.5561 6.44395C36.8069 5.69476 35.9155 5.10294 34.9343 4.70328C33.953 4.30362 32.9018 4.1042 31.8424 4.11674L29.3949 4.14424L27.6844 2.39524V2.39249ZM28.4736 18.8485L20.2236 27.0985C20.0959 27.2265 19.9441 27.3281 19.7771 27.3974C19.61 27.4668 19.431 27.5024 19.2501 27.5024C19.0692 27.5024 18.8902 27.4668 18.7231 27.3974C18.5561 27.3281 18.4043 27.2265 18.2766 27.0985L14.1516 22.9735C14.0238 22.8456 13.9224 22.6939 13.8532 22.5268C13.784 22.3598 13.7484 22.1808 13.7484 22C13.7484 21.8192 13.784 21.6402 13.8532 21.4731C13.9224 21.3061 14.0238 21.1543 14.1516 21.0265C14.2794 20.8986 14.4312 20.7972 14.5982 20.728C14.7653 20.6589 14.9443 20.6232 15.1251 20.6232C15.3059 20.6232 15.4849 20.6589 15.652 20.728C15.819 20.7972 15.9708 20.8986 16.0986 21.0265L19.2501 24.1807L26.5266 16.9015C26.7848 16.6433 27.135 16.4982 27.5001 16.4982C27.8652 16.4982 28.2154 16.6433 28.4736 16.9015C28.7318 17.1597 28.8768 17.5099 28.8768 17.875C28.8768 18.2401 28.7318 18.5903 28.4736 18.8485V18.8485Z" fill="#58CA9A" />
                                    </svg>


                                <?php
                                }
                                ?>
                            </div>

                            <div class="flex center">
                                <?php
                                if ($_SESSION["id"] == $arrayAllPost[0][0]["id"]) {
                                ?>
                                    <a class="button_style mgRight10" href="#">Edit profil</a>
                                    <a class="button_style" href="deconnexion.php">Deconnexion</a>
                                <?php
                                } else if ($isFollow == true) {


                                ?>
                                    <div class="button_style2 mgRight10 follow animFollow">
                                        <lottie-player id="lottie2" src="ASSETS/icones/addFollow.json" background="transparent" speed="0.8" style="width: 28px; height: 28px;" autoplay></lottie-player>
                                    </div>
                                    <a class="button_style" href="sendmessage.php?idReceveur=<?= $arrayAllPost[0][0]["id"]; ?>">écrire</a>

                                <?php
                                } else if ($isFollow == false) {
                                ?>
                                    <div class="button_style2 mgRight10 follow animFollowAppear" id="" idUser="<?= $arrayAllPost[0][0]["id"] ?>">
                                        s'abonner
                                    </div>

                                    <a class="button_style" href="sendmessage.php?idReceveur=<?= $arrayAllPost[0][0]["id"]; ?>"><span>écrire</span></a>

                                <?php

                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex center row gap20 cursorNone">
                            <p class="regular"><span class="bolded">15</span> publications</p>
                            <p class="regular lookAbonner" onclick="lookAbonnement('abonner')" > <span class="bolded countAbonner">0 </span> abonnés</p>
                            <p class="regular lookAbonnement" onclick="lookAbonnement('abonnement')"><span class="bolded countAbonnement">0</span> abonnements</p>
                        </div>
                        <div>
                            <p class="userBio">
                                <?= $arrayAllPost[0][0]["bio"]; ?> </p>
                        </div>
                    </section>
                </section>
                <section class="maxWidth2">
                    <hr class="hrCustom">
                    <div class="flex row cursorNone itemPublication">
                        <p style="font-size:18px">Publication</p><svg width="25" height="25" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 4.6875C0 3.4443 0.49386 2.25201 1.37294 1.37294C2.25201 0.49386 3.4443 0 4.6875 0L45.3125 0C46.5557 0 47.748 0.49386 48.6271 1.37294C49.5061 2.25201 50 3.4443 50 4.6875V45.3125C50 46.5557 49.5061 47.748 48.6271 48.6271C47.748 49.5061 46.5557 50 45.3125 50H4.6875C3.4443 50 2.25201 49.5061 1.37294 48.6271C0.49386 47.748 0 46.5557 0 45.3125L0 4.6875ZM4.6875 3.125C4.2731 3.125 3.87567 3.28962 3.58265 3.58265C3.28962 3.87567 3.125 4.2731 3.125 4.6875V15.625H15.625V3.125H4.6875ZM15.625 18.75H3.125V31.25H15.625V18.75ZM18.75 31.25H31.25V18.75H18.75V31.25ZM15.625 34.375H3.125V45.3125C3.125 45.7269 3.28962 46.1243 3.58265 46.4174C3.87567 46.7104 4.2731 46.875 4.6875 46.875H15.625V34.375ZM18.75 34.375V46.875H31.25V34.375H18.75ZM34.375 34.375V46.875H45.3125C45.7269 46.875 46.1243 46.7104 46.4174 46.4174C46.7104 46.1243 46.875 45.7269 46.875 45.3125V34.375H34.375ZM34.375 31.25H46.875V18.75H34.375V31.25ZM34.375 15.625H46.875V4.6875C46.875 4.2731 46.7104 3.87567 46.4174 3.58265C46.1243 3.28962 45.7269 3.125 45.3125 3.125H34.375V15.625ZM31.25 15.625V3.125H18.75V15.625H31.25Z" fill="#58CA9A" />
                        </svg>
                    </div>
                </section>
                <section class="flex alignItemStart wrap">

                    <?php

                    foreach ($arrayAllPost[0] as $postData) {


                    ?>
                        <article class="postMiniCard flex center" style="background-image: url('ASSETS/post/<?= $postData["image_post"] ?>')">
                            <div class="flex center hoverPostMiniCard">
                                <aside class="flex center columns gap0">
                                    <svg id="like_ico" postid="" action="add" width="18" height="18" loading="lazy" viewBox="0 0 50 50" fill="none" style="fill:'+liked+'" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.625 8.33333C9.29683 8.33333 4.16663 13.4635 4.16663 19.7917C4.16663 31.25 17.7083 41.6667 25 44.0896C32.2916 41.6667 45.8333 31.25 45.8333 19.7917C45.8333 13.4635 40.7031 8.33333 34.375 8.33333C30.5 8.33333 27.0729 10.2573 25 13.2021C23.9434 11.6971 22.5397 10.4688 20.9078 9.62134C19.2759 8.77384 17.4638 8.33203 15.625 8.33333Z" postid="" action="add" stroke="#58CA9A" stroke-width="4.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="nbrLike"> <?= $postData["likeTotal"] ?></p>
                                </aside>
                                <aside class="flex center columns gap0">
                                    <svg id="commentaire_ico" width="18" height="18" viewBox="0 0 50 50" fill="none" loading="lazy" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.6563 25C22.6563 25.6216 22.9032 26.2177 23.3428 26.6573C23.7823 27.0968 24.3784 27.3438 25 27.3438C25.6216 27.3438 26.2178 27.0968 26.6573 26.6573C27.0969 26.2177 27.3438 25.6216 27.3438 25C27.3438 24.3784 27.0969 23.7823 26.6573 23.3427C26.2178 22.9032 25.6216 22.6563 25 22.6562C24.3784 22.6563 23.7823 22.9032 23.3428 23.3427C22.9032 23.7823 22.6563 24.3784 22.6563 25V25ZM32.4219 25C32.4219 25.6216 32.6688 26.2177 33.1084 26.6573C33.5479 27.0968 34.1441 27.3438 34.7657 27.3438C35.3873 27.3438 35.9834 27.0968 36.4229 26.6573C36.8625 26.2177 37.1094 25.6216 37.1094 25C37.1094 24.3784 36.8625 23.7823 36.4229 23.3427C35.9834 22.9032 35.3873 22.6563 34.7657 22.6562C34.1441 22.6563 33.5479 22.9032 33.1084 23.3427C32.6688 23.7823 32.4219 24.3784 32.4219 25ZM12.8907 25C12.8907 25.6216 13.1376 26.2177 13.5771 26.6573C14.0167 27.0968 14.6128 27.3438 15.2344 27.3438C15.856 27.3438 16.4522 27.0968 16.8917 26.6573C17.3312 26.2177 17.5782 25.6216 17.5782 25C17.5782 24.3784 17.3312 23.7823 16.8917 23.3427C16.4522 22.9032 15.856 22.6563 15.2344 22.6562C14.6128 22.6563 14.0167 22.9032 13.5771 23.3427C13.1376 23.7823 12.8907 24.3784 12.8907 25V25ZM45.1758 16.5234C44.0723 13.9014 42.4903 11.5479 40.4737 9.52637C38.4712 7.51658 36.0939 5.91905 33.4766 4.82422C30.791 3.69629 27.9395 3.125 25 3.125H24.9024C21.9434 3.13965 19.0772 3.72559 16.3819 4.87793C13.7869 5.98399 11.432 7.58436 9.44828 9.58984C7.4512 11.6064 5.88382 13.9502 4.79984 16.5625C3.67679 19.2676 3.11038 22.1436 3.12503 25.1025C3.1416 28.4935 3.94384 31.8345 5.46878 34.8633V42.2852C5.46878 42.8809 5.70542 43.4522 6.12665 43.8734C6.54787 44.2946 7.11918 44.5312 7.71488 44.5312H15.1416C18.1704 46.0562 21.5114 46.8584 24.9024 46.875H25.0049C27.9297 46.875 30.7666 46.3086 33.4375 45.2002C36.0417 44.1184 38.41 42.5395 40.4102 40.5518C42.4268 38.5547 44.0137 36.2207 45.1221 33.6182C46.2744 30.9229 46.8604 28.0566 46.875 25.0977C46.8897 22.124 46.3135 19.2383 45.1758 16.5234V16.5234ZM37.7979 37.9102C34.375 41.2988 29.834 43.1641 25 43.1641H24.917C21.9727 43.1494 19.0479 42.417 16.4649 41.04L16.0547 40.8203H9.17972V33.9453L8.95999 33.5352C7.58304 30.9521 6.85062 28.0273 6.83597 25.083C6.81644 20.2148 8.67679 15.6445 12.0899 12.2021C15.4981 8.75977 20.0537 6.85547 24.9219 6.83594H25.0049C27.4463 6.83594 29.8145 7.30957 32.0459 8.24707C34.2237 9.16016 36.1768 10.4736 37.8565 12.1533C39.5313 13.8281 40.8496 15.7861 41.7627 17.9639C42.71 20.2197 43.1836 22.6123 43.1739 25.083C43.1446 29.9463 41.2354 34.502 37.7979 37.9102V37.9102Z" fill="#58CA9A" />
                                    </svg>
                                    <p class="nbrComment"> <?= $postData["comTotal"] ?></p>
                                </aside>
                            </div>
                        </article>

                    <?php
                    }
                    ?>



                </section>
            </section>


            <!--Nombre abonnement!-->
            <section class=" flex center nbAbonnement cursorNone">
                <section class=" flex center ">
                    <section class="card fixed cursorNone " style="z-index: 8;padding-left: 0; padding-right: 0">
                        <div class=" flex row center spaceArround">
                            <div class="flex row spaceBetween center paddingLR10">
                                <p>Liste d'abonnement</p>
                                <svg id="exitCreatePostModal" onclick="exitModalAbonnement()" width="25" height="25" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.8 0H31.2C33.2687 0 35.2526 0.821783 36.7154 2.28457C38.1782 3.74735 39 5.73131 39 7.8V31.2C39 33.2687 38.1782 35.2526 36.7154 36.7154C35.2526 38.1782 33.2687 39 31.2 39H7.8C5.73131 39 3.74735 38.1782 2.28457 36.7154C0.821783 35.2526 0 33.2687 0 31.2V7.8C0 5.73131 0.821783 3.74735 2.28457 2.28457C3.74735 0.821783 5.73131 0 7.8 0V0ZM7.8 3.9C6.76566 3.9 5.77368 4.31089 5.04228 5.04228C4.31089 5.77368 3.9 6.76566 3.9 7.8V31.2C3.9 32.2343 4.31089 33.2263 5.04228 33.9577C5.77368 34.6891 6.76566 35.1 7.8 35.1H31.2C32.2343 35.1 33.2263 34.6891 33.9577 33.9577C34.6891 33.2263 35.1 32.2343 35.1 31.2V7.8C35.1 6.76566 34.6891 5.77368 33.9577 5.04228C33.2263 4.31089 32.2343 3.9 31.2 3.9H7.8ZM22.2573 19.5L27.7739 25.0146C28.1397 25.3805 28.3453 25.8768 28.3453 26.3942C28.3453 26.9117 28.1397 27.408 27.7739 27.7739C27.408 28.1397 26.9117 28.3453 26.3942 28.3453C25.8768 28.3453 25.3805 28.1397 25.0146 27.7739L19.5 22.2573L13.9854 27.7739C13.6195 28.1397 13.1232 28.3453 12.6058 28.3453C12.0883 28.3453 11.592 28.1397 11.2262 27.7739C10.8603 27.408 10.6547 26.9117 10.6547 26.3942C10.6547 25.8768 10.8603 25.3805 11.2262 25.0146L16.7427 19.5L11.2262 13.9854C10.8603 13.6195 10.6547 13.1232 10.6547 12.6058C10.6547 12.0883 10.8603 11.592 11.2262 11.2262C11.592 10.8603 12.0883 10.6547 12.6058 10.6547C13.1232 10.6547 13.6195 10.8603 13.9854 11.2262L19.5 16.7427L25.0146 11.2262C25.3805 10.8603 25.8768 10.6547 26.3942 10.6547C26.9117 10.6547 27.408 10.8603 27.7739 11.2262C28.1397 11.592 28.3453 12.0883 28.3453 12.6058C28.3453 13.1232 28.1397 13.6195 27.7739 13.9854L22.2573 19.5Z" fill="#58CA9A" />
                                </svg>
                            </div>
                        </div>
                        <hr class="customHr">
                        <div id="data" class="flex center">
                            <lottie-player id="lottie" src="ASSETS/icones/loadingHetix.json" background="transparent" speed="1" style="width: 50px; height: 50px;position: absolute;top: 25%;" loop autoplay></lottie-player>
                        </div>
                        <div id="abonnement">

                        </div>

                    </section>
                </section>
            </section>



               <!--Nombre abonner!-->
               <section class=" flex center nbAbonnement cursorNone">
                <section class=" flex center ">
                    <section class="card fixed cursorNone " style="z-index: 8;padding-left: 0; padding-right: 0">
                        <div class=" flex row center spaceArround">
                            <div class="flex row spaceBetween center paddingLR10">
                                <p>Liste d'abonnement</p>
                                <svg id="exitCreatePostModal" onclick="exitModalAbonnement()" width="25" height="25" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.8 0H31.2C33.2687 0 35.2526 0.821783 36.7154 2.28457C38.1782 3.74735 39 5.73131 39 7.8V31.2C39 33.2687 38.1782 35.2526 36.7154 36.7154C35.2526 38.1782 33.2687 39 31.2 39H7.8C5.73131 39 3.74735 38.1782 2.28457 36.7154C0.821783 35.2526 0 33.2687 0 31.2V7.8C0 5.73131 0.821783 3.74735 2.28457 2.28457C3.74735 0.821783 5.73131 0 7.8 0V0ZM7.8 3.9C6.76566 3.9 5.77368 4.31089 5.04228 5.04228C4.31089 5.77368 3.9 6.76566 3.9 7.8V31.2C3.9 32.2343 4.31089 33.2263 5.04228 33.9577C5.77368 34.6891 6.76566 35.1 7.8 35.1H31.2C32.2343 35.1 33.2263 34.6891 33.9577 33.9577C34.6891 33.2263 35.1 32.2343 35.1 31.2V7.8C35.1 6.76566 34.6891 5.77368 33.9577 5.04228C33.2263 4.31089 32.2343 3.9 31.2 3.9H7.8ZM22.2573 19.5L27.7739 25.0146C28.1397 25.3805 28.3453 25.8768 28.3453 26.3942C28.3453 26.9117 28.1397 27.408 27.7739 27.7739C27.408 28.1397 26.9117 28.3453 26.3942 28.3453C25.8768 28.3453 25.3805 28.1397 25.0146 27.7739L19.5 22.2573L13.9854 27.7739C13.6195 28.1397 13.1232 28.3453 12.6058 28.3453C12.0883 28.3453 11.592 28.1397 11.2262 27.7739C10.8603 27.408 10.6547 26.9117 10.6547 26.3942C10.6547 25.8768 10.8603 25.3805 11.2262 25.0146L16.7427 19.5L11.2262 13.9854C10.8603 13.6195 10.6547 13.1232 10.6547 12.6058C10.6547 12.0883 10.8603 11.592 11.2262 11.2262C11.592 10.8603 12.0883 10.6547 12.6058 10.6547C13.1232 10.6547 13.6195 10.8603 13.9854 11.2262L19.5 16.7427L25.0146 11.2262C25.3805 10.8603 25.8768 10.6547 26.3942 10.6547C26.9117 10.6547 27.408 10.8603 27.7739 11.2262C28.1397 11.592 28.3453 12.0883 28.3453 12.6058C28.3453 13.1232 28.1397 13.6195 27.7739 13.9854L22.2573 19.5Z" fill="#58CA9A" />
                                </svg>
                            </div>
                        </div>
                        <hr class="customHr">
                        <div id="data" class="flex center">
                            <lottie-player id="lottie" src="ASSETS/icones/loadingHetix.json" background="transparent" speed="1" style="width: 50px; height: 50px;position: absolute;top: 25%;" loop autoplay></lottie-player>
                        </div>
                        <div id="abonnement">

                        </div>

                    </section>
                </section>
            </section>



        </main>

        </body>
        <script src="JS/urlParam.js" defer></script>
        <script src="JS/allFollowing.js" defer></script>
        <script src="JS/follow.js" defer></script>
        <script src="JS/headerInteract.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        
        <script src="JS/notificationPush.js" defer></script>
        <script src="JS/frontInteraction.js" defer></script>
        <script src="JS/createNewPost.js" defer></script>
       
        </html>

        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<?php
    } else {
        echo " <div class='flex center' style='align-items: center;height: 80vh;align-items: center;'>Profil non trouvé</div>";
    }
} else {
    header("Location:connexion.php?erreur=4");
}
?>