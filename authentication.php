<?php

require_once './inc/init.php';
require_once './inc/head_inc.php';

// var_dump($connect);
?>

<title>CoyoTech | Connexion</title>
</head>

<body class="registrar-body">


    <!--------------TRAITEMENT--------------->

    <?php

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header('location:index.php');
  }

    $error = '';


    if ($_POST) {
        $formPseudo = $_POST['pseudo'];
        $formPassword = $_POST['password'];

        if (!empty($formPseudo)) {

            $req = $connect->query("SELECT * FROM user WHERE pseudo = '$formPseudo'");

            if ($req->rowCount() >= 1) {

                $user = $req->fetch(PDO::FETCH_ASSOC);


                if (password_verify($formPassword, $user['password'])) {

                    $_SESSION['user']['pseudo'] = $user['pseudo'];

                    header('location:admin/projects_management.php');
                } else {

                    $error .= '<div class="alert alert-danger" role="alert">
                    Il y a une erreur dans le mot de passe !
                    </div>';
                }
            } else {

                $error .= '<div class="alert alert-danger" role="alert">
                Il y a une erreur dans le pseudo !
                </div>';
            }
        }
        $alert .= $error;
    }


    ?>

    <?php
    require_once './inc/header_inc.php';
    ?>


    <h1 class="text-center home-h1 mt-4">CoyoTech | Connexion</h1>
    <hr>
    <div class="container mt-3 mb-3">
        <p class="text-center text-danger">
            <strong>Hey !</strong> Vous tentez d'accéder à du contenu qui nécéssite d'être connecté !
        </p>
    </div>
    <p class="text-center home-p mt-3 mb-3">Saisissez vos pseudo et mot de passe pour vous connecter.</p>
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
            <button type="submit" name="submit" class="btn btn-registrar">Se connecter</button>
        </form>
    </div>

    <?php
    require_once './inc/footer_inc.php';
    ?>