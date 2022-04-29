<?php try {
    $bdd = new PDO('mysql:dbname=epitech_tp;host=localhost', 'root', 'root');
} catch (Exception $e) {
    die('Connexion échoué :' . $e->getMessage());
}

$queryUpdate = $bdd->prepare("update membre set id_abo = ? where id_fiche_perso = ?");

if($_GET['abo'] == "NULL"){
    $queryUpdate->execute(array(NULL, $_GET['member']));
}
else{
    $queryUpdate->execute(array($_GET['abo'], $_GET['member']));
}
header('Location:editClient.php?membre='.$_GET['member']);
