<?php
include('selectDistrib.php');
include('client.php');

$pagination = $bdd->query('select count(nom) as "data" from fiche_personne where nom like "%' . $_GET['client'] . '%" OR prenom like "%' . $_GET['client'] . '%"');
$data = $pagination->fetch();

$nbr= $data['data'];


if (isset($_GET['p'])) {
    $pageCourante = $_GET['p'];
} else {
    $pageCourante = 1;
}



$perPage = $_GET['perPage'];
$nbrPage = ceil($nbr / $perPage);


$client = 'select * from fiche_personne where nom like "%' . $_GET['client'] . '%" OR prenom like "%' . $_GET['client'] . '%" limit ' . (($pageCourante - 1) * $perPage) . ',' . $perPage;
$clientResult = "";
if ($_GET['client'] != "") {

    $clientQuery = $bdd->query($client);

    if ($clientQuery->rowCount() > 0) {
        while ($arrayClient = $clientQuery->fetch()) {

            $clientResult .= '<div class="boxresult">
        <p>Nom: ' . $arrayClient['nom'] . '</p>
        <p>Prenom: ' . $arrayClient['prenom'] . '</p>
        <form action="editClient.php" method="get">
        <input type="hidden" name="membre" value="' . $arrayClient['id_perso'] . '">
        <input type="submit" value="Voir le profil">
        </form>
        </div><br>';
        }
    } else
        $clientResult = "<div class='boxresult'><p>Aucun membre ne correspond à votre recherche</p></div>";
} else {
    exit('<div class="boxresult"><p>Merci de saisir un nom ou un prénom !</p></div>');
}

?>

<div class="clientResult">
    <?php echo $clientResult;
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $nbrPage; $i++) {
        echo ' <a href="clientSearch.php?client=' . $_GET['client'] . '&perPage=' . $_GET['perPage'] . '&p=' . $i . '"> ' . $i . ' </a>';
    }
    echo "</div>";
    echo "Page courante: ".$pageCourante;
    ?>
</div>
