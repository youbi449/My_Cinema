<?php
include('selectDistrib.php');
include('structureHtml/head.html');
include('structureHtml/header.html');

$selectAbonnement = "";
$infoClient = "";
$aboClient = "";

$queryInfoClient = $bdd->prepare("select * from fiche_personne where id_perso=?");
$queryInfoClient->execute(array($_GET['membre']));
$idMembre = $bdd->prepare("select id_membre from membre,fiche_personne where membre.id_membre = fiche_personne.id_perso && id_fiche_perso=?");
$idMembre->execute(array($_GET['membre']));
$querySelectAbonnement = $bdd->query("select id_abo,nom from abonnement");
$queryAboClient = $bdd->prepare('select * from membre where id_fiche_perso=?');  /* Requête pour recupérer les donnés de l'utilisateur selectionner dans les résultats */
$queryAboClient->execute(array($_GET['membre']));
$displayAboClient = $queryAboClient->fetch();
$queryGetAboFromClient = $bdd->prepare('select * from abonnement where id_abo=?');
$queryGetAboFromClient->execute(array($displayAboClient['id_abo']));    

$getAboFromClient = $queryGetAboFromClient->fetch();
$getidMembre = $idMembre->fetch();
$aboClient = $getAboFromClient['nom'];
foreach ($querySelectAbonnement as $selecto) {
    $selectAbonnement .= '<option value="' . $selecto['id_abo'] . '">' . $selecto['nom'] . '</option>' . PHP_EOL;
}

while ($displayInfoClient = $queryInfoClient->fetch()) {
    $infoClient .= '<div class="editClient"><p>Nom: ' . $displayInfoClient['nom'] . '</p>
    <p>Prenom: ' . $displayInfoClient['prenom'] . '</p>
    <p>Email: ' . $displayInfoClient['email'] . '</p>
    <p>Code postal: ' . $displayInfoClient['cpostal'] . '</p>
    <p>Ville: ' . $displayInfoClient['ville'] . '</p>
    <p>Abonnement en cours: ' . $aboClient . '</p>

    <form method="get" action="editSub.php">
    <select name="abo" id="abo">
    <option>Choose</option>' . $selectAbonnement . '<option value="NULL">Supprimer</option></select>
    <input type="hidden" name="member" value="'.$displayInfoClient['id_perso'].'"> 
    <input type="submit" value="Edit Subscribe"></form><br>
    
    <form method="get" action="historiqueMembre.php">
    <input type="hidden" name="memberhistory" value="'. $getidMembre['id_membre'].'">
    <input type="hidden" name="nomhistory" value="'. $displayInfoClient['nom'].'">
    <input type="hidden" name="prenomhistory" value="'. $displayInfoClient['prenom'].'">
    <label for="perPagehistory">Trier par</label>
    <select name="perPageHistory">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
    </select>
    <input type="submit" value="View member\'s history">
    </form> 
    </div>';
}
?>

<body>
    <?php echo $infoClient; ?>
</body>