<?php

require_once './inc/init.php';
require_once './inc/head_inc.php';

// var_dump($connect);
?>

<title>CoyoTech | Accueil</title>
</head>

<body>


    <!--------------TRAITEMENT--------------->

    <?php



    $error = '';

    $viewReq = $connect->query("SELECT * FROM project ORDER BY project_id DESC LIMIT 3");

    $projects = $viewReq->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <?php
    require_once './inc/header_inc.php';
    ?>
    <div class="container-fluid catchphrase mb-5">
        <p>Développement d'applications Web ou Web mobile / Création de sites Internet / Web Design</p>
    </div>
    <div class="container mb-3 mt-5 d-flex flex-wrap">

        <div class="row main d-flex align-items-center">
            <div class=" col-12 col-lg-6 mb-4 d-flex flex-column align-items-center justify-content-center main-text">
                <h1 class="main-h1">Hello ! Je suis <br><span class="auto">Nicolas</span></h1>

                <p>
                    J'exerce à Compiègne dans les Hauts-de-France.<br>Après avoir entamé une reconversion vers les métiers du Web en 2017, j'ai pu développer mes compétences en ayant suivi 3 formations certifiantes depuis cette date et ai également occupé un poste de Coordinateur de projets digitaux pendant 2 ans dans l'un des centres m'ayant formé.
                </p>
                <a href="<?= URL ?>contact.php" class="btn btn-registrar">Consultez-moi</a>
            </div>
            <div class=" col-12 col-lg-6 mb-4 d-flex align-items-center justify-content-center">
                <img src="./img/main-hero.png" class="img-fluid" alt="Hero Image">
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 mb-3 d-flex flex-wrap dark-blue">
        <div class="col-12 mb-4 mt-4 d-flex flex-column align-items-center main-text">
            <h2 class="text-center mt-4 main-h2">Découvrez <span>mes projets</span></h2>
            <p class="text-center">Que ce soit pour des projets personnels ou élaborés dans le cadre des formations que j'ai suivies, voici un extrait de mes créations. <br>Cliquez pour en découvrir l'intégralité.</p>
            <div class="col-4 d-flex justify-content-center">
                <a href="<?= URL ?>projects_list.php" class="btn btn-registrar px-4">Mes projets</a>
            </div>
        </div>
        <div class="col-12 mb-5 mt-5 d-flex flex-wrap">

            <?php foreach ($projects as $project) { ?>
                <div class="col-12 card-main col-lg-4 d-flex justify-content-center">
                    <div class="card project-card h-100" style="width: 25rem;">
                        <img src="<?php echo $project['picture']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $project['title']; ?></h5>
                            <p class="card-text"><?php echo $project['chapo']; ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="<?= URL ?>project_view.php?project=<?php echo $project['project_id']; ?>" class="btn btn-registrar">Voir le projet</a>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
    <div class="container-fluid d-flex flex-column mb-5">
        <div class="col-12 mb-4 mt-4 d-flex flex-column main-text">
            <h2 class="text-center mt-4 main-h2">Et si nous <span>discutions ?</span></h2>
            <p class="text-center">Que vous ayez besoin de proposer vos produits ou services et les vendre en ligne.<br>Ou tout simplement prospecter ou être facilement consulté sur Internet.<br>Parlons-en !</p>
        </div>
        <div class="row d-flex justify-content-center mt-5 mb-5" id="contact">
            <div class="col-10 col-lg-6">
                <form action="" method="POST" class="form-floating">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name">
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                        <label for="message">Message</label>
                    </div>
                    <button type="submit" class="btn btn-registrar">Envoyer</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        var typed = new Typed(".auto", {
            strings: ["Nicolas Jumeaucourt", "Développeur Web", "et Web Mobile", "en PHP/JavaScript", " et Symfony"],
            typeSpeed: 120,
            backSpeed: 120,
            loop: true,
        });
    </script>
    <?php
    require_once './inc/footer_inc.php';
    ?>