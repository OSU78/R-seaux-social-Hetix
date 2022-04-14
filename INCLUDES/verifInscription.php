<?php
require_once ("config.php");
include("createSession.php");
//requete INSERT INTO user( id,pseudo,nom,prenom,email,mdp ) VALUES (null,"d", "d","dd","d","d");
if(isset($_POST['submit']))
{
    // echo $_POST['nom']."<br>";
    // echo $_POST['prenom']."<br>";
    // echo $_POST['pseudo']."<br>";
    // echo $_POST['mdp1']."<br>";
    // echo $_POST['mdp2']."<br>";
  /*securisation des variable du formulaire*/
  $prenom=htmlspecialchars($_POST['prenom']);
  $nom=htmlspecialchars($_POST['nom']);
  $pseudo=htmlspecialchars($_POST['pseudo']);
  $email=htmlspecialchars($_POST['email']);
  $mdp1=htmlspecialchars($_POST['mdp1']);
  $mdp2=htmlspecialchars($_POST['mdp2']);
 
  
  /*--------------------------------------*/
  /*Condition de leur validation*/
  /*--------------------------------------*/
  /*Condition de leur validation*/
  if(isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['mdp1']) && !empty($_POST['mdp1']) && isset($_POST['mdp2']) && !empty($_POST['mdp2']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pseudo']) && !empty($_POST['pseudo']))
  {
      if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $requser=$bdd->prepare('SELECT * FROM user WHERE email= ?');
        $requser->execute(array($email));
        $email_exist=$requser->rowCount();

        if($email_exist==0)
        {

          /*envoi de mail de confirmation*/
          $longueurKey = 15;/*LONGUEUR DE LA CLE DE CONFIRMATION 15*/
          $key = "";
          for($i=1;$i<$longueurKey;$i++) {
            $key .= mt_rand(1,9);
          }
          $mdp=$mdp1;
                     //KEY EST LA CLE ALEATOIREMENT GENERER
          /*on securise le mot de passe du client*/
          $mdpsec=hash('sha256', $mdp);
          $confirme=0;
          /*REQUETE PREPARER D'INSERTION DU NOUVEAU MEMBRES*/

          $insertmbr=$bdd->prepare("INSERT INTO user( id,pseudo,nom,prenom,email,keyC,userVerifier,mdp) VALUES (null,?,?,?,?,?,?,?);
          ");
          $insertmbr->execute(array($pseudo, $nom, $prenom,$email,$key,$confirme,$mdpsec));


                     //CONTENUE DU MESSAGE
          $header = "MIME-Version: 1.0\r\n";
          $header.='From:"hetix.com"<support@Hetix-service.com>'."\n";
          $header.='Content-Type:text/html; charset="uft-8"'."\n";
          $header.='Content-Transfer-Encoding: 8bit';
          $message='
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style type="text/css">
      * {
        -ms-text-size-adjust:100%;
        -webkit-text-size-adjust:none;
        -webkit-text-resize:100%;
        text-resize:100%;
      }
      a{
        outline:none;
        color:#40aceb;
        text-decoration:underline;
      }
      a:hover{text-decoration:none !important;}
      .nav a:hover{text-decoration:underline !important;}
      .title a:hover{text-decoration:underline !important;}
      .title-2 a:hover{text-decoration:underline !important;}
      .btn:hover{opacity:0.8;}
      .btn a:hover{text-decoration:none !important;}
      .btn{
        -webkit-transition:all 0.3s ease;
        -moz-transition:all 0.3s ease;
        -ms-transition:all 0.3s ease;
        transition:all 0.3s ease;
      }
      table td {border-collapse: collapse !important;}
      .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
      @media only screen and (max-width:500px) {
        table[class="flexible"]{width:100% !important;}
        table[class="center"]{
          float:none !important;
          margin:0 auto !important;
        }
        *[class="hide"]{
          display:none !important;
          width:0 !important;
          height:0 !important;
          padding:0 !important;
          font-size:0 !important;
          line-height:0 !important;
        }
        td[class="img-flex"] img{
          width:100% !important;
          height:auto !important;
        }
        td[class="aligncenter"]{text-align:center !important;}
        th[class="flex"]{
          display:block !important;
          width:100% !important;
        }
        td[class="wrapper"]{padding:0 !important;}
        td[class="holder"]{padding:30px 15px 20px !important;}
        td[class="nav"]{
          padding:20px 0 0 !important;
          text-align:center !important;
        }
        td[class="h-auto"]{height:auto !important;}
        td[class="description"]{padding:30px 20px !important;}
        td[class="i-120"] img{
          width:120px !important;
          height:auto !important;
        }
        td[class="footer"]{padding:5px 20px 20px !important;}
        td[class="footer"] td[class="aligncenter"]{
          line-height:25px !important;
          padding:20px 0 0 !important;
        }
        tr[class="table-holder"]{
          display:table !important;
          width:100% !important;
        }
        th[class="thead"]{display:table-header-group !important; width:100% !important;}
        th[class="tfoot"]{display:table-footer-group !important; width:100% !important;}
      }
    </style>
          <td data-bgcolor="bg-module" bgcolor="#eaeced">
                <table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                  <tbody>
                  <tr>
                    <td data-bgcolor="bg-block" class="holder" style="padding:65px 60px 50px;" bgcolor="#f9f9f9">
                      <table width="100%" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                          <td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                          
                            <img src="https://i.ibb.co/kBgC25V/logo2.png" alt="logo2" border="0"  width="120px">
                          </font></font></td>
                        </tr>
                        <tr>
                          <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Bonjour '.$prenom.' votre profil Hetix😀 a été crée avec succès.Veuillez confirmer votre adresse email en cliquant sur le lien ci-dessous.
                          </font></font></td>
                        </tr>
                       
                        <tr>
                          <td style="padding:0 0 20px;">
                            <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                              <tbody><tr>
                                <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#31be52">
                                  <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://phphetic/HETIX/confirmation?email='.urlencode($email).'&key='.$key.'"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Confirmez votre compte</font></font></a>
                                </td>
                              </tr>
                            </tbody></table>
                          </td>
                        </tr>
                      </tbody></table>
                    </td>
                  </tr>
                  <tr><td height="28"></td></tr>
                </tbody></table>
              </td>
          ';
          /*urlencode pourque tout transite parfaitement bien*/
          mail($email, "Confirmation de compte", $message, $header);
                     /*FIN MAIL
                     //LE MAIL SERA ENVOYER SUR LE COMPTE DE LA PERSONNE*/

                     $req_user = $bdd->prepare('SELECT * FROM user WHERE email =? AND mdp =?');
                     //var_dump($req_user);
                     $req_user->execute(array($email, $mdpsec));
                     //print_r($email);
                     //print_r($mdpsec);
                     $user_info = $req_user->fetch();
                     //var_dump($user_info);
                     $user_exist = $req_user->rowCount();
                     if ($user_exist >= 1) {
                         createSession($user_info);
                         header("Location:../homePage.php?email=" . $_SESSION['pseudo'] . "&ID=" . $_SESSION['session_start']);
                     } else { 
                     /*On appel la fonction qui permet de crée la session de l'utilisateur*/
                      header('Location: ../connexion.php?erreur=sessioncreatefailed');
                    }
                     
                   }
                   else{
                    header('Location: ../connexion.php?erreur=emailAlreadyExit');
                    }
                 }else{
                    header('Location: ../index.php?erreur=emailInvalide'); 
                    $msg='Adresse mail Invalide';}

             }
             else{header('Location: ../index.php?erreur="field"');}

           }
