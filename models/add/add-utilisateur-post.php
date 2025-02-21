<?php
#inclusion de la page de connexion
include ('../../connexion/connexion.php');
// Appel de lq fonction
require_once ('../../fonctions/fonctions.php');
// creation de l'evenement sur le bouton valider
if (isset($_POST['valider'])) {
  $nom = htmlspecialchars($_POST['nom']);
  $postnom = htmlspecialchars($_POST['postnom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $genre = htmlspecialchars($_POST['genre']);
  $adresse = htmlspecialchars($_POST['adresse']);
  $telephone = htmlspecialchars($_POST['telephone']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['pwd']);
  $boutique = htmlspecialchars($_POST['boutique']);
  $fonction = htmlspecialchars($_POST['fonction']);

  /**
   * Here’s the translation of your logic into English: “Here, we have hashed the password. So, for a new user, you first need to create a file that will allow you to hash the password in order to log in. Please create this file outside of this ‘dk’ project.”
   * for example
   * $pwd=1234;
   * $hash = password_hash($pwd, PASSWORD_DEFAULT);
   * print $hash;
   */

  // password hashing
  $passwordh = $password;
  $passwordhacher = password_hash($passwordh, PASSWORD_DEFAULT);
  // recuperer l'image
  $image = $_FILES['photo']['name'];
  $file = $_FILES['photo'];
  $destination = "../../assets/img/profiles/" . basename($image);
  // fonction permettant de recuperer la photo
  $newimage = RecuperPhoto($image, $file, $destination);
  // verification si la variable newimage a un element
  if ($newimage != 0) {
    #verifier si l'utilisateur existe ou pas dans la bd
    $getBoutiqueUtilisateurs = $connexion->prepare("SELECT * FROM `utilisateur` WHERE telephone=? AND supprimer=?");
    $getBoutiqueUtilisateurs->execute([$telephone, 0]);
    $tab = $getBoutiqueUtilisateurs->fetch();
    // verification si la variable tab est superieur à zéro
    if ($tab > 0) {
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
      header("location:../../views/utilisateur.php");
    } else {
      // verifier la validité du numero de télephone
      if (is_numeric($telephone)) {
        //Insertion data from database
        $req = $connexion->prepare("INSERT INTO utilisateur ( nom, postnom, prenom, genre, adresse, telephone, email, pwd, boutique, fonction,photo) values (?,?,?,?,?,?,?,?,?,?,?)");
        $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $adresse, $telephone, $email, $passwordhacher, $boutique, $fonction, $newimage]);
        if ($resultat == true) {
          $_SESSION['msg'] = "Enregistrement réussie";
          header("location:../../views/utilisateur.php");
        } else {
          $_SESSION['msg'] = "Echec d'enregistrement";
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
        header("location:../../views/utilisateur.php");
      }
    }
  } else {
    $_SESSION['msg'] = "Le format de l'image que vous avez choisi n'est pas autorisé";
    header("location:../../views/utilisateur.php");
  }

} else {
  header("location:../../views/utilisateur.php");
}
?>