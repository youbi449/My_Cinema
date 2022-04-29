<?php
include('selectDistrib.php');
$displayResult = "";

$query = 'select titre,id_film from film where titre like "%' . $_GET['film'] . '%"';
$subQuery = "";


if ($_GET['genre'] != "Default") {
    $query .= ' && id_genre="' . $_GET['genre'] . '"';
    $subQuery .= ' && id_genre="' . $_GET['genre'] . '"';
}

if ($_GET['distrib'] != "Default") {
    $query .= ' && id_distrib ="' . $_GET['distrib'] . '"';
    $subQuery .= ' && id_distrib ="' . $_GET['distrib'] . '"';
 
}

$countFilm = $bdd->query('select count(titre) as "count titre" from film where titre like "%' . $_GET['film'] . '%" '.$subQuery);
$resultCountFilm = $countFilm->fetch();
if($resultCountFilm['count titre'] == 3680)
$resultCountFilm['count titre'] = 0;

$nbrFilm = $resultCountFilm['count titre'];
$perPages = $_GET['perPageFilm'];
$nbrPage = ceil($nbrFilm / $perPages);

if (isset($_GET['p'])) {
    $pageCourante = $_GET['p'];
} else {
    $pageCourante = 1;
}




if ($_GET['genre'] == "Default" && $_GET['distrib'] == "Default" && $_GET['film'] == "") {
    $query = "";
    $displayResult = "<div class='result'><p>Veuillez saisir une recherche</p></div>";
}



if ($query !== "") {
    $display = $bdd->query($query.' limit '. (($pageCourante - 1) * $perPages) . ',' . $perPages);


    if ($display->rowCount() > 0) {
        while ($answa = $display->fetch()) {
            $displayResult .= "<div class ='result'><p><strong>Nom du film : </strong>" . $answa['titre'] . "</div></p>";
        }
    } else {
        $displayResult = "<div class ='result'><p>Aucun film ne correspond à votre recherche.</p></div>";
    }
}

include('index.php');
echo $displayResult;
echo "<div class='pagination'>";
for ($i = 1; $i <= $nbrPage; $i++) {
    echo '<a href="search.php?film='.$_GET['film'].'&distrib='.$_GET['distrib'].'&genre='.$_GET['genre'].'&perPageFilm='.$_GET['perPageFilm'].'&p='.$i.'"> ' . $i . ' </a>';
}
echo "</div>";
if($query !== ""){
echo "Page courante: ".$pageCourante;
}
else{
    exit;
}

