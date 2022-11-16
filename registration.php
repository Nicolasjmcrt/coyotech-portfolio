<?php

require_once './inc/init.php';
require_once './inc/head_inc.php';

// var_dump($connect);
if (!userConnected()) {
  header('location:./index.php');
}

?>

<title>CoyoTech | Inscription</title>
</head>

<body class="registrar-body">


    <!--------------TRAITEMENT--------------->

    <?php

    $error = '';

    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars(addslashes($value));
    }

    if ($_POST) {
        $pseudo = $_POST['pseudo'];
        $pattern = '#^[a-zA-Z0-9._-]+$#';

        // Vérification de la longueur du pseudo
        if (strlen($pseudo) < 3 || strlen($pseudo) > 20) {
            $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Votre pseudo doit contenir entre 3 et 20 caractères.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }


        // Vérification des caractères du pseudo
        // preg_match() permet de vérifier une correpondance avec une expression régulière (regex)
        if (!preg_match($pattern, $pseudo)) {
            $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Votre pseudo n\'est pas valide ! Seuls les minuscules majuscules, nombres, tirets (-) et underscore (_) sont autorisés.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }


        // Vérification si pseudo existant dans BDD
        // En utilisant rowCount(), afficher un message d'erreur si le pseudo existe déjà
        $req = $connect->query("SELECT * FROM user WHERE pseudo = '$pseudo'");
        $state = $req->rowCount();

        if ($state >= 1) {
            $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Ce pseudo est déjà utilisé !
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }


        // Vérification si champ password vide
        if (empty($_POST['password'])) {
            $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Vous devez saisir un mot de passe !
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }


        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // password hashé avec password_hash()


        // Insérer user dans la base de données

        if (empty($error)) {
            $connect->query("INSERT INTO user(pseudo,password) VALUES ('$pseudo','$password')");

            $error .= '<div class="alert alert-dismissible fade show alert-success" role="alert">
            L\'utilisateur a bien été enregistré !
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }

        $alert .= $error;
    }


    ?>

    <?php
    require_once './inc/header_inc.php';
    ?>


    <h1 class="text-center home-h1 mt-4">CoyoTech | Inscription</h1>
    <p class="text-center home-p mt-3 mb-3">Choisissez un pseudo et un mot de passe pour créer votre compte</p>
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <?= $alert; ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" name="submit" class="btn btn-registrar">S'inscrire</button>
        </form>
    </div>

    <?php
        require_once './inc/footer_inc.php';
    ?>