<?php
include('index.php');

$_GET['dateAffiche'] = str_replace("-", "", $_GET['dateAffiche']);

$semainePagination = $bdd->prepare('SELECT count(titre) as "weekCount" FROM film WHERE date_debut_affiche <= ? AND  date_fin_affiche >=? ORDER BY titre ASC');
$semainePagination->execute(array(
    $_GET['dateAffiche'],
    $_GET['dateAffiche']
));
$resultSemainePagination = $semainePagination->fetch();

$nbrFilm  = $resultSemainePagination['weekCount'];
$perPages = $_GET['perPageWeek'];
$nbrPage  = ceil($nbrFilm / $perPages);

if (isset($_GET['p'])) {
    $pageCourante = $_GET['p'];
} else {
    $pageCourante = 1;
}


$searchSemaine = $bdd->prepare('SELECT * FROM film WHERE date_debut_affiche <= ? AND  date_fin_affiche >=? ORDER BY titre ASC limit ' . (($pageCourante - 1) * $perPages) . ',' . $perPages);
$searchSemaine->execute(array(
    $_GET['dateAffiche'],
    $_GET['dateAffiche']
));

if ($_GET['dateAffiche'] != "") {
    if ($searchSemaine->rowCount() > 0) {
        while ($displayFilmSemaine = $searchSemaine->fetch()) {
            echo '<div class="result"><strong>Nom du film: </strong>' . $displayFilmSemaine['titre'] . '</div>';
        }
        echo "<div class='pagination'>";
        for ($i = 1; $i <= $nbrPage; $i++) {
            echo ' <a href="filmSemaine.php?dateAffiche=' . $_GET['dateAffiche'] . '&perPageWeek=' . $perPages . '&p=' . $i . '">' . $i . ' </a>';
        }
        echo "</div>";
        echo "Page courante: ".$pageCourante;
    } else {
        echo '<div class="result"><p>Aucun film n\'est projeté cet semaine</p></div>';
    }
} else {
    echo '<div class="result"><p>Votre date n\'est pas valide</p></div>';
} 