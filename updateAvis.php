<?php

include('selectDistrib.php');

$newAvis = $bdd->prepare('update historique_membre set avis=? where id_membre=? && id_film=?');
$newAvis->execute(array($_GET['avisduclikos'], $_GET['id_membre'], $_GET['filmavis']));

include('structureHtml/head.html');
include('structureHtml/header.html');
?>

<span class="avisConfirm" style="color:green">Votre avis a bien été pris en compte !<br></span>
<?php header( "refresh:5;url=index.php"); ?>
<span class="avisConfirm2">Vous allez être rediriger dans les 5 secondes si ca ne fonctionne pas cliquer <a href="index.php">ici</a></span>
