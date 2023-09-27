<?php
if (isset($_POST['save'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_telephone = $_POST['numero_telephone'];
    $adresse_email = $_POST['adresse_email'];

    // Vérifiez que $numero_telephone ne contient que des chiffres
    // et que $adresse_email est une adresse e-mail valide
    if ($nom && $prenom && is_numeric($numero_telephone) && filter_var($adresse_email, FILTER_VALIDATE_EMAIL)) {
        try {
            $db = new PDO("mysql:host=localhost; dbname=bd_simplon_ci", "root", "");
            $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Utilisez une requête préparée avec des paramètres liés
            $insert = $db->prepare("INSERT INTO participants(nom,prenom,numero_telephone,adresse_email) VALUES(:nom, :prenom, :numero_telephone, :adresse_email)");

            // Liez les valeurs aux paramètres
            $insert->bindParam(':nom', $nom);
            $insert->bindParam(':prenom', $prenom);
            $insert->bindParam(':numero_telephone', $numero_telephone);
            $insert->bindParam(':adresse_email', $adresse_email);

            //Exécutez la requête                    
            $insert->execute();
            echo '<h2>Vous êtes enregistré.</h2>';
        } catch (PDOException $e) {
            echo '<h2>Une erreur s\'est produite : ' . $e->getMessage() . '</h2>';
            die();
        }
    } else {
        echo '<h4>Remplissez tous les champs et rassurez vous que votre telephone et votre e-mail sont corrects.</h4>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'Inscription</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="#" class="navbar-brand">formulaire d'inscription</a>
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
    <div class="row g-3">
        <div class="col col-md-12 col-lg-12 text-center">
            <h1>EMMARGEMENT</h1>

            <form action="" method="POST">
                <div class="row justify-content-center">
                    <div class="row g-3  col-md-8 col-lg-8">
                        <!-- Champ Nom -->
                        <div class="col pt-3 text-center">
                            <input type="text" name="nom" class="form-control" placeholder="Nom" aria-label="nom">
                        </div>

                        <!-- Champ Prenom -->
                        <div class="col pt-3">
                            <input type="text" name="prenom" class="form-control" placeholder="Prenoms" aria-label="prenom">
                        </div>

                        <!-- Champ Numéro de Téléphone -->
                        <div class="col pt-3 text-center">
                            <input type="text" name="numero_telephone" class="form-control" placeholder="Numéro de Téléphone" aria-label="numero_telephone">
                        </div>

                        <!-- Champ Adresse E-mail -->
                        <div class="col pt-3">
                            <input type="text" name="adresse_email" class="form-control" placeholder="Adresse E-mail" aria-label="adresse_email">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="row g-3  col-md-12 col-lg-12">
                        <div class="col pt-3 d-grid gap-2 text-center">
                            <button id="btn6" name="save">ENREGISTRER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

