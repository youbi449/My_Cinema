
<!doctype html>
<html>

<head>
    <title>Youbi Cinema</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<?php
include('structureHtml/header.html');
?>

<body>
    <form class="client" action="clientSearch.php" method="get">
        <h4>Rechercher un membre</h4>
        <input type="text" name="client" placeholder="Saisissez votre requête">
        <label for="perPage">Trier par</label>
        <select name="perPage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>  
        </select>
        <input type="submit" value="Rechercher">
    </form>
</body>