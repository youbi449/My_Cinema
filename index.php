<?php
include('selectDistrib.php');
include('structureHtml/head.html');
include('structureHtml/header.html');
?>
<form class="client" action="search.php" method="get">
    <h4>Rechercher un film</h4>
    <input type="text" name="film" placeholder="Rechercher un film">
    <select name="distrib" id="distrib">Selectionner un distributeur
        <option value="Default">Selectionner un distributeur</option>
        <?php echo $select; ?>
    </select>
    <select name="genre" id="genre">
        <option value="Default">Selectionner un genre</option>
        <?php echo $genreSelect; ?>
    </select>
    <label for="perPageFilm">Trier par</label>
    <select name="perPageFilm">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>
    <input type="submit" value="Rechercher"><br>
</form>
<form class="semaine" action="filmSemaine.php" method="get">
    <label for="dateAffiche">Rechercher par date de projection</label>
    <input type="date" name="dateAffiche">
    <label for="perPageWeek">Trier par</label>
    <select name="perPageWeek">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>
    <input type="submit" value="Rechercher">
</form>
</form>