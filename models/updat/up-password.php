        <?php
            //la connexion a la base de donnees
            include_once('../../connexion/connexion.php');

            //la creation de l'evenement qui sert à envoyer les données à la base de donnée
            
            
            //Lors qu'on a cliquer sur le bouton valider

            if (isset($_POST['valider']) && isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])) {
                $_id =$_SESSION['iduser'];
                $_ancienmotdepasse=htmlspecialchars($_POST['password']);
                $_newmotdepasse=htmlspecialchars($_POST['newpassword']);
                $_renewmotdepasse=htmlspecialchars($_POST['renewpassword']);

                $req = $connexion->prepare("SELECT utilisateur.pwd  FROM utilisateur WHERE id=? and utilisateur.supprimer=0");
                $req->execute([$_id]);
                if($tab=$req->fetch()){
                    $pwd=$tab['pwd'];
                    if(password_verify($_ancienmotdepasse, $pwd)) {
                        if($_newmotdepasse === $_renewmotdepasse) {
                            $_upData = $connexion->prepare("UPDATE utilisateur SET pwd=? WHERE id=?");
                            $_rows = $_upData->execute([password_hash($_newmotdepasse, PASSWORD_DEFAULT), $_id]);
                            if ($_rows == 1) {
                                $_SESSION['msg'] = "La modification reussie";
                                header("Location:../../views/users-profile.php");
                            } else {
                                $_SESSION['msg'] = "Echec de la modification";
                                header("Location:up-profil-post.php?idMod=" . $_id);
                            }    
                        } else {
                            $_SESSION['msg'] = "Le nouveau mot de passe et confirmation ne correspondent pas";
                            header("Location:up-profil-post.php?idMod=" . $_id);
                        }
                    } else {
                        $_SESSION['msg'] = "L'ancien mot de passe est incorrect";
                        header("Location:up-profil-post.php?idMod=" . $_id);
                    }
                }else{
                    $_SESSION['msg'] = "Aucun mot de passe trouvé";
                    header("Location:up-profil-post.php?idMod=" . $_id);
                }
            } else {
                header("Location:../../views/users-profile.php");
            }
