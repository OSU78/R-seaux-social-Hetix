<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="apple-touch-icon" sizes="76x76" href="./ASSETS/icones/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./ASSETS/icones/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./ASSETS/icones/favicon-16x16.png">
    <link rel="manifest" href="./ASSETS/icones/site.webmanifest">
    <link rel="mask-icon" href="./ASSETS/icones/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="./ASSETS/icones/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/ASSETS/icones/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hetix : Se connecter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/formulaire.css">

</head>

<body class="theme">
    <main class="flex row center vh100">
        <section class="section1 flex top columns flexStart " style="height:-webkit-fill-available;padding-left: 80px;">  
            <div class="">
                <img src="ASSETS/icones/logo.png" alt="logo site" srcset="" width="100px">
                <p class="font32">
                   Ah content de te revoir !
                </p>
                <p class="minip">Application en partenariat avec OsuDev</p>

            </div>
            <div class="list">
                <li class="check_icon">Accède à un réseau soudés</li>
                <li class="check_icon">+1200 membres actifs</li>
                <li class="check_icon">Du contenu et des conseils adaptés</li>
            </div>

        </section>

        <section class="section2 flex top columns center2">

            <div class="flex columns center">
                <img src="./ASSETS/icones/logo2.png" width="120px">
                <p class="customP">Connecte toi pour voir les
                    photos et vidéos de tes amis.</p>
                <h1 class="h1-title">CONNEXION</h1>
            </div>

            <!-- Formulaire d'inscription -->
            <form method="post" class="form card" name="connexion" action="INCLUDES/verifConnexion.php">



                <div class="inputText">
                    <p>Email</p>
                    <div><input type="email" name="email" id="email" placeholder="Entrez votre email"></div>

                </div>

                <div class="input">
                    <p>Mot de passe</p>
                    <input type="password" name="mdp1" id="mdp1" placeholder="Entrez un mot de passe">
                </div>

                <div class="input submit">
                    <input type="submit" value="CONNEXION" name="submit">
                    <p id="erreur"></p>

                </div>
            </form>
            <section class="card" style="width: 80%;padding-bottom : 2px">
                <div class="flex row center">
                    <p>Tu est nouveau sur la plateforme ?</p> <a href="index.php" class="links2">Créé un compte !</a>
                </div>
            </section>

            <ul class="flex row center footerul">
                <li> <a href="https://github.com/OSU78" class="links" target="_blank"> Le github</a></li>
                <li><a href="https://www.linkedin.com/in/ousmane-dev" class="links" target="_blank">Linkedin</a></li>
                <li>@2022 Hetix by osu78</li>
            </ul>

        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="./JS/urlParam.js" defer></script>
    <script src="./JS/notificationPush.js" defer></script>
    <script src="./JS/frontInteraction.js"></script>
    <script src="./JS/verificationForm_min.js" defer></script>
   
</body>

</html>