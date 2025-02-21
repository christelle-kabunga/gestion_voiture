<?php
    include '../connexion/connexion.php';//Se connecter à la BD
    if(isset($_SESSION['msge']) and $_SESSION['msge']!="")
    {
        $msg=$_SESSION['msge'];
    }
    if(isset($_GET['idcom']))
    {
        $idcom=$_GET['idcom'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Commandes</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php require_once('style.php'); ?>

</head>

<body>

    <!-- Appel de menues  -->
    <?php require_once('asideCom.php') ?>

    <main id="main" class="main">
        <div class="row">
            <div class="col-12">
                <h4>Vois les Commandes</h4>
            </div>
            <!-- pour afficher les massage  -->
            <?php if(isset($msg))
                {
                    ?>
                        <div class="alert-info alert text-center"> <?php echo $msg; $_SESSION['msge']=""; ?> </div>
                    <?php
                }
            ?>
        </div>

            <!-- La tableau qui affiche les données du panier -->
            <div class="col-xl-12 table-responsive px-3 card mt-4 px-4 pt-3">
                <table class="table table-borderless datatable ">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Description</th>
                            <th>Quantite</th>
                            <th>Prix</th>
                            <th>Total</th>
                            <th>Produits</th>
                            <th>Clients</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $req=$connexion->prepare("SELECT panier.id, panier.description, panier.quantite, panier.prix, panier.entree, panier.commande,client.nom,client.prenom,commande.id, produit.nom , categorie.description, panier.quantite*panier.prix as tot FROM panier, commande, client, produit, categorie, stock_general, entree WHERE produit.categorie=categorie.id AND stock_general.produit=produit.id AND entree.stock_general= stock_general.id AND commande.client=client.id AND panier.commande=commande.id AND panier.statut=0 and panier.entree=entree.id and commande.id=?;");
                            $req->execute(array($idcom));
                            $numero=0;
                            while($client=$req->fetch()){
                                $numero++;
                                $numFac= $_GET['idcom'];
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $numero?></th>
                                        <td><?php echo $client['1']?></td>
                                        <td><?php echo $client['2']?></td>
                                        <td><?php echo $client['3']?>$</td>
                                        <td><?php echo $client['tot']?>$</td>
                                        <td>
                                            <?php echo $client['9']?> /
                                            <?php echo $client['10']?>
                                        </td>
                                        <td>
                                            <?php echo $client['6']?>
                                            <?php echo $client['7']?>
                                        </td>
                                        <td>
                                            <a href="commande.php?idpanier=<?php echo $client['0']?>" class="btn btn-dark btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a  onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-commande-post.php?idpanier=<?php echo $client['0']?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>

                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                <a href="facture.php?idcom=<?php echo $numFac ;?>" target="facture.php?idcom=<?php echo $numFac ;?>" class="btn btn-primary w-100">Imprimer la facture pour cette commande</a>
            </div>
    </main><!-- End #main -->
    <?php require_once('script.php') ?>

</body>

</html>