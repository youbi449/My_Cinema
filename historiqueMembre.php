<?php
include('selectDistrib.php');
include('structureHtml/head.html');
include('structureHtml/header.html');

$historiquePagination = $bdd->query('SELECT count(*) as "historiqueCount" from film,historique_membre where film.id_film = historique_membre.id_film && historique_membre.id_membre="' . $_GET['memberhistory'] . '" order by date desc');

$resultHistoriquePagination = $historiquePagination->fetch();

$nbrFilm = $resultHistoriquePagination['historiqueCount'];
$perPages = $_GET['perPageHistory'];
$nbrPage = ceil($nbrFilm / $perPages);

if (isset($_GET['p'])) {
    $pageCourante = $_GET['p'];
} else {
    $pageCourante = 1;
}




$historiqueMembre = "";

$queryHistorique = $bdd->query('SELECT * from film,historique_membre where film.id_film = historique_membre.id_film && historique_membre.id_membre="' . $_GET['memberhistory'] . '" order by date desc limit ' . (($pageCourante - 1) * $perPages) . ',' . $perPages);
while ($resultHistorique = $queryHistorique->fetch()) {
    $historiqueMembre .= '<div class="historiqueMembre"><strong>Nom du film: </strong>' . $resultHistorique['titre'] . '
                          <p><strong>Vu le: </strong>' . $resultHistorique['date'] . '</p>
                          <form method="get" action="addAvis.php">
                          <input type="hidden" name="id_film" value="' . $resultHistorique['id_film'] . '">
                          <input type="hidden" name="idMembre" value="' . $_GET['memberhistory'] . '">
                          <input type="hidden" name="date" value="' . $resultHistorique['date'] . '">
                          <input type="submit" value="Ajouter un avis">
                          </form></div><br>';
}
?>

<div class="title">
    <?php
    echo '<h4>Historique de ' . ucfirst($_GET['nomhistory']) . ' ' . ucfirst($_GET['prenomhistory']) . '</br>';
    ?>
</div>
<div class="addhistory">
    <form method="get" action="addHistory.php">
        <select name="film" id="film">
            <?php echo $displayFilm; ?>
        </select>
        <input type="hidden" name="redirectSecondName" value="<?php echo $_GET['prenomhistory'] ?>">
        <input type="hidden" name="redirectName" value="<?php echo $_GET['nomhistory'] ?>">
        <input type="hidden" name="idofuser" value="<?php echo $_GET['memberhistory'] ?>">
        <input type="hidden" name="date" value="<?php echo date('Y-m-d', time()); ?>">
        <input type="hidden" name="parPage" value="<?php echo $nbrPage; ?>">
        <input type="submit" value="Ajouter le film a l'historique">
    </form>
</div>

</form>

<?php echo $historiqueMembre;
echo "<div class='pagination'>";
for ($i = 1; $i <= $nbrPage; $i++) {
    echo ' <a href="historiqueMembre.php?memberhistory=' . $_GET['memberhistory'] . '&nomhistory=' . $_GET['nomhistory'] . '&prenomhistory=' . $_GET['prenomhistory'] . '&perPageHistory='.$_GET['perPageHistory'].'&p='.$i.'"> ' . $i . ' </a>';
}
echo "</div>";
echo "Page courante: ".$pageCourante;
?>