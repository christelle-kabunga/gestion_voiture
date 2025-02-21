    <?php
    //la connexion a la base de donnees
    include_once('../../connexion/connexion.php');
    include_once('../../fonctions/fonctions.php');

    //la creation de l'evenement qui sert à envoyer les données à la base de données
    //Lors qu'on a cliquer sur le bouton valider

    if (isset($_POST['valider']) && isset($_GET['idMod']) && !empty($_GET['idMod'])) {
        $_id = $_GET['idMod'];
        $_nom = htmlspecialchars($_POST['nom']);
        $_postnom = htmlspecialchars($_POST['postnom']);
        $_prenom = htmlspecialchars($_POST['prenom']);
        $_genre = htmlspecialchars($_POST['genre']);
        $_adresse = htmlspecialchars($_POST['adresse']);
        $_telephone = htmlspecialchars($_POST['telephone']);
        // recupereration de l'image
        $image = $_FILES['photo']['name'];
        $file = $_FILES['photo'];
        $destination = "../../assets/image/" . basename($image);

        // la fonction qui permet de recuperer la photo
        $newimage = RecuperPhoto($image, $file, $destination);

        print $newimage;

        if($newimage != "" && $newimage != -1 ){
            if($newimage == 0){
                $_SESSION['msg'] = "Le format de cette image n'est pas recomandé dans ce système";
                header("Location:../../views/users-profile.php");
            } else {
                $_upData = $connexion->prepare("UPDATE utilisateur SET  nom=?, postnom=?, prenom=?,genre=?,adresse=?,telephone=?,photo=? WHERE id=?");
                $_rows = $_upData->execute([$_nom, $_postnom, $_prenom, $_genre, $_adresse, $_telephone, $newimage, $_id]);
                if ($_rows == 1) {
                    $_SESSION['msg'] = "La modification reussie";
                    header("Location:../../views/users-profile.php");
                } else {
                    $_SESSION['msg'] = "Echec de la modification";
                    header("Location:../../views/users-profile.php");
                }
            }
        } else {
            $_upData = $connexion->prepare("UPDATE utilisateur SET  nom=?, postnom=?, prenom=?,genre=?,adresse=?,telephone=? WHERE id=?");
            $_rows = $_upData->execute([$_nom, $_postnom, $_prenom, $_genre, $_adresse, $_telephone, $_id]);
            if ($_rows == 1) {
                $_SESSION['msg'] = "La modification reussie";
                header("Location:../../views/users-profile.php");
            } else {
                $_SESSION['msg'] = "Echec de la modification";
                header("Location:../../views/users-profile.php");
            }
        }
    }else{
        header("Location:../../views/users-profile.php");
    }
        