<?php
include('structureHtml/head.html');
include('structureHtml/header.html');

print_r($_GET);

try{
    $bdd = new PDO('mysql:dbname=epitech_tp;host=localhost','root','root');
}
catch(Exception $e){
    die('Connexion échoué :' .$e->getMessage());
}

$addHistory = $bdd->prepare('insert into historique_membre (id_membre,id_film,date) values (?,?,?)');
$addHistory->execute(array($_GET['idofuser'],$_GET['film'],$_GET['date']));

header('location:historiqueMembre.php?memberhistory='.$_GET['idofuser'].'&nomhistory='.$_GET['redirectName'].'&prenomhistory='.$_GET['redirectSecondName'].'&perPageHistory='.$_GET['parPage'].'&p=1');