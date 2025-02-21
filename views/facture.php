<?php

    include '../connexion/connexion.php';
    if(isset($_GET['idcom']))
        {
            $idcom=$_GET['idcom'];
        } 
    require('../fpdf/html_Tables/html_table.php');

    // $pdf=new PDF();
    $pdf = new PDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);    
    $req=$connexion->prepare("SELECT panier.id, panier.description, panier.quantite, panier.prix, 
    panier.entree, panier.commande,client.nom,client.prenom,commande.id, produit.nom ,
     categorie.description, panier.quantite*panier.prix as tot,boutique.nom 
     FROM panier, commande, client, produit, categorie, stock_general, entree,boutique 
     WHERE produit.categorie=categorie.id AND stock_general.produit=produit.id 
     AND entree.stock_general= stock_general.id AND commande.client=client.id 
     AND panier.commande=commande.id AND panier.statut=0 and panier.entree=entree.id 
     and entree.boutique=boutique.id and commande.id=?;");
    $req->execute(array($idcom));
    $client=$req->fetch();
    $numero=0;
    //entete
    // //recuperation de la date d'impression   
    $dateactuel=date('Y-m-d');
    $pdf->SetFont('Arial','i',12); 
    $pdf->Cell(w:100, h:10, txt:''); //marge de 10 
    $pdf->Cell(w:10, h:10, txt:'Butembo : le '.$dateactuel);
    $pdf->ln(h:12); 
    $pdf->SetFont('Arial','B',14); 
    $pdf->Cell(w:10, h:10, txt:'');  //marge de 10 
    $pdf->Cell(w:50, h:10, txt:'KATEMBO KYOKWE FAUSTIN', align:'c' );
    $pdf->SetFont('Arial','',12); 
    $pdf->ln(h:8);    
    $pdf->Cell(w:10, h:10, txt:'');  //marge de 10 
    $pdf->Cell(w:50, h:10, txt:'Boutique :'.$client['12'] );
    $pdf->ln(h:8);    
    $pdf->Cell(w:10, h:10, txt:'');  //marge de 10 
    $pdf->Cell(w:50, h:10, txt:'CD/GON/RCCM/14-A01603', align:'c' );
    $pdf->ln(h:8);
    $pdf->Cell(w:10, h:10, txt:'');  //marge de 10 
    $pdf->Cell(w:50, h:10, txt:'No IMPORT EXP:G/007-13/10007707', align:'c' );
    $pdf->ln(h:8);
    $pdf->Cell(w:10, h:10, txt:'');  //marge de 10 
    $pdf->Cell(w:50, h:10, txt:'No IDNAT: 5-13-K30557 Z', align:'c' );
    $pdf->ln(h:8);
    $pdf->Cell(w:10, h:10, txt:'');  //marge de 10 
    $pdf->Cell(w:50, h:10, txt:'TEL:0998383727; 0998385358', align:'c' );
    $pdf->ln(h:12); 
    

    // le titre
    $pdf->SetFont('Arial','B',20);  
    $pdf->Cell(w:70, h:10, txt:'', align:'c' ); //marge de 70 pour centrer le text     
    $pdf->Cell(w:50, h:10, txt:'Facture No: '.$idcom, align:'c' );
    $pdf->SetFont('Arial','',12); 
    $pdf->ln(h:16);
    $pdf->Cell(w:10, h:10, txt:'');  //marge de 10     
    $pdf->Cell(w:0, h:10, txt:'Mr,Mm : '.$client['6'].' '.$client['7']);        
    $pdf->ln(h:18);
    //table data of the bill
    $html1="<table border='1'>
        <tr>
           <td width='50' height='50'><b>No</b></td><td width='90' height='50'><b>Qte</b></td><td width='250' height='50' ><b>Libelle</b></td><td width='100' height='50' ><b>P.U</b></td><td width='150' height='50' ><b>P.T</b></td>
        </tr>        
    </table>";
$pdf->WriteHTML($html1);
//$pdf->ln(h:1);

    $req=$connexion->prepare("SELECT panier.id, panier.description, panier.quantite, panier.prix, panier.entree, panier.commande,client.nom,client.prenom,commande.id, produit.nom, categorie.description, panier.quantite*panier.prix as tot FROM panier, commande, client, produit, categorie, stock_general, entree WHERE produit.categorie=categorie.id AND stock_general.produit=produit.id AND entree.stock_general= stock_general.id AND commande.client=client.id AND panier.commande=commande.id AND panier.statut=0 and panier.entree=entree.id and commande.id=?;");
    $req->execute(array($idcom));
    $numero=0;
    $totalgeneral=0;
    while($client=$req->fetch())
    
    {
        $tot=$client['tot'];
        $quant=$client['2'];
        $prixx=$client['3'];
        $desc=$client['1'];
        $numero++;
        $totalgeneral=$totalgeneral+$tot;

        

       
    $html="<table border='1'>       
        <tr>
    <td width='50' height='50'>$numero</td><td width='90' height='50'>$quant</td><td width='250' height='50'>$desc</td><td width='100' height='50' ><b>$prixx</b></td><td width='150' height='50' ><b>$tot</b></td>
        </tr>
    </table>";

 
    $pdf->ln(h:-2);
    $pdf->WriteHTML($html);
 
     

}
$html2="<table border='1'>
               
<tr>


    <td width='490' height='50'> <b>TOTAL</b></td><td width='150' height='50' ><b>$totalgeneral</b></td>
</tr>
</table>";
$pdf->ln(h:-2);
$pdf->WriteHTML($html2);
$pdf->SetFont('Arial','i',9);
$pdf->Cell(w:50, h:10, txt:"");  //marge de 10 
$pdf->Cell(w:50, h:10, txt:' Les marchandise vendus ne sont ni remises ni echangees' );
$pdf->Output();
?>
