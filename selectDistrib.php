<?php 

try{
    $bdd = new PDO('mysql:dbname=epitech_tp;host=localhost','root','root');
}
catch(Exception $e){
    die('Connexion échoué :' .$e->getMessage());
}

$distrib = $bdd->query("select * from distrib order by nom asc");

$select = "";

while ($answer = $distrib->fetch()) {
    $select .= "<option value='" . $answer['id_distrib'] . "'>" . $answer['nom'] . "</option> \n";
}

$genre = $bdd->query("select * from genre order by nom asc ");

$genreSelect = "";

while($answerDistrib = $genre->fetch()){
    $genreSelect .= "<option value='". $answerDistrib['id_genre']."'>".$answerDistrib['nom']. "</option> \n";
}

$allFilm = $bdd->query('select * from film order by titre asc');
$displayFilm = "";
while($answerFilm = $allFilm->fetch()){
    $displayFilm .= '<option value="'.$answerFilm['id_film'].'">'.$answerFilm['titre'].'</option>';
}