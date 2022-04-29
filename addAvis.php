<?php
include('structureHtml/head.html');
include('structureHtml/header.html');
include('selectDistrib.php');

$queryDisplayInfoFilm = $bdd->prepare('select * from film where id_film= ?');
$queryDisplayInfoFilm->execute(array($_GET['id_film']));

$getInfoFilm = $queryDisplayInfoFilm->fetch();
?>

<div class="avisFilm">
    <?php
      echo '<h3>'.$getInfoFilm['titre'].'</h3>
            <p><strong>Resumé: </strong>'.$getInfoFilm['resum'].'<br>
            <p>Vous avez vu ce film à la date suivante: '.$_GET['date'].'</p><br>
            <form action="updateAvis.php" method="get">
            <input type="hidden" name="id_membre" value="'.$_GET['idMembre'].'">
            <input type="hidden" name="filmavis" value="'.$getInfoFilm['id_film'].'">
            <textarea name="avisduclikos" rows="5" cols="30" placeholder="Merci de ne pas faire usage d\'insulte"></textarea>
            <input type="submit" value="Ajouter l\'avis !">';
    ?>
</div>