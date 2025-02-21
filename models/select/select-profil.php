
<?php
if (isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])) {
    $id = $_SESSION['iduser'];
    //requette qui permet d'afficher les données existant dans la base des données
    $getDatamod = $connexion->prepare("SELECT * FROM utilisateur WHERE id=?");
    $getDatamod->execute(array($id));
    // on s'assure que les informations ont été recupere
    if ($_tab = $getDatamod->fetch()) {
        $_nom =  $_tab[1];
        $_postnom =  $_tab[2];
        $_prenom =  $_tab[3];
        $_genre = $_tab[4];
        $_adresse =  $_tab[5];
        $_telephone =  $_tab[6];
        $_image = $_tab[11];
    } else {
        $_SESSION['msg'] = "Aucune information trouvée";
    }
} else {

}
