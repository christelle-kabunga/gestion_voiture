<?php
include ('../../connexion/connexion.php');

if (isset($_POST['valider']) && !empty($_GET['iduser'])) {
  $id = $_GET['iduser'];
  $nom = htmlspecialchars($_POST['nom']);
  $postnom = htmlspecialchars($_POST['postnom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $genre = htmlspecialchars($_POST['genre']);
  $adresse = htmlspecialchars($_POST['adresse']);
  $telephone = htmlspecialchars($_POST['telephone']);
  $email = htmlspecialchars($_POST['email']);
  $pwd = htmlspecialchars($_POST['pwd']);
  $fonction = htmlspecialchars($_POST['fonction']);
  $photo = htmlspecialchars($_POST['photo']);
  $boutique = htmlspecialchars($_POST['boutique']);

  //select data from database
  $getBoutiqueUtilisateurs = $connexion->prepare("SELECT * FROM `utilisateur` WHERE telephone=? AND supprimer=?");
  $getBoutiqueUtilisateurs->execute([$telephone, 0]);
 
  // verification si la variable tab est superieur à zéro
  if ($tab=$getBoutiqueUtilisateurs->fetch()) {
    $_SESSION['msg'] = 'Cet Utlisateur existe dejà dans la base de données';//Cette variable recoit le message pour notifier l'utilisateur de l'opération qu'il deja fait
    $_SESSION['recupnom'] = $nom;
      $_SESSION['recuppost'] = $postnom;
      $_SESSION['recupprenom'] = $prenom;
      $_SESSION['recupgenre'] = $genre;
      $_SESSION['recupadresse'] = $adresse;
      $_SESSION['recuptel'] = $telephone;
      $_SESSION['recupmail'] = $email;
      $_SESSION['recuppwd'] = $password;
      $_SESSION['recupfonct'] = $fonction;
      $_SESSION['recupBout'] = $boutique;
    header("location:../../views/utilisateur.php?idRecupUser=$id");
  }
  else
  {
    if (is_numeric($telephone)) {
      $req = $connexion->prepare("UPDATE `utilisateur` SET  nom=?,postnom=?,prenom=?,genre=?,adresse=?,telephone=?,email=?,pwd=?,boutique=?, fonction=?, photo=? WHERE id='$id'");
      $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $adresse, $telephone, $email, $pwd, $boutique, $fonction, $photo]);
      if ($resultat == true) {
        $msg = "Modification réussie";
        $_SESSION['msg'] = $msg;
        header("location:../../views/utilisateur.php");
      }
    } else {
      $_SESSION['msg'] = "Le numero de téléphone ne doit pas être une chaîne de caractère";
      $_SESSION['recupnom'] = $nom;
      $_SESSION['recuppost'] = $postnom;
      $_SESSION['recupprenom'] = $prenom;
      $_SESSION['recupgenre'] = $genre;
      $_SESSION['recupadresse'] = $adresse;
      $_SESSION['recuptel'] = $telephone;
      $_SESSION['recupmail'] = $email;
      $_SESSION['recuppwd'] = $password;
      $_SESSION['recupfonct'] = $fonction;
      $_SESSION['recupBout'] = $boutique;
      header("location:../../views/utilisateur.php?idRecupUser=$id");
    }

  }
 
} else {
  header("location:../../views/utilisateur.php");
}

