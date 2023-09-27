<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Participants</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="index.php" class="navbar-brand">formulaire d'inscription</a>
      <button type="button" data-toggle="collapse" class="navbar-toggler" data-target="#navbarsExampleDefault" aria-controls="#navbarsExampleDefault" aria-expanded="false" aria-label="toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav_item">
          <a href="liste_presence.php" class="nav-link">VOIR LA LISTE DE PRESENCE</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input type="text" class="form-control mr-sm-2" placeholder="Rechercher" aria-label="Rechercher">
          <button type="submit" class="btn my-2 my-sm-0 btn-outline-success" > <span class="fa fa-search"></span> </button>
        </form>
      </div>
    </nav>
<?php
try {
    $db = new PDO("mysql:host=localhost; dbname=bd_simplon_ci", "root", "");
    $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sélectionnez toutes les données de la table "participants"
    $query = $db->query("SELECT * FROM participants");

    // Affichez les données dans un tableau HTML
    
    echo "<h1>Liste des Participants</h1>";
    echo "<table border='1'>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Numéro de Téléphone</th>
                <th>Adresse E-mail</th>
                <th>Actions</th>
            </tr>";

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['nom']}</td>
                <td>{$row['prenom']}</td>
                <td>{$row['numero_telephone']}</td>
                <td>{$row['adresse_email']}</td>
                <td>
                    <a href='modifier.php?id={$row['id']}'>Modifier</a> |
                    <a href='supprimer.php?id={$row['id']}'>Supprimer</a>
                </td>
              </tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo 'Une erreur s\'est produite : ' . $e->getMessage();
    die();
}
?>
</body>
</html>
