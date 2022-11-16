<?php

require_once './inc/init.php';
require_once './inc/head_inc.php';

// var_dump($connect);
?>

<title>CoyoTech | Détails du projet</title>
</head>

<body>


    <!--------------TRAITEMENT--------------->


    <?php

    if (isset($_GET['project'])) {
        $reqParam = $connect->query("SELECT * FROM project WHERE project_id = '$_GET[project]'");
        if ($reqParam->rowCount() <= 0) {
            header('location:index.php');
        }
    }

    if (isset($_GET['project'])) {

        $reqProj = $connect->query("SELECT * FROM project WHERE project_id = '$_GET[project]'");

        $project = $reqProj->fetch(PDO::FETCH_ASSOC);
    }

    ?>
    <?php
    require_once './inc/header_inc.php';
    ?>

    <h1 class="text-center home-h1 mt-4">CoyoTech | Détails du projet</h1>
    <h2 class="text-center project-h2 mt-2"><?php echo $project['title']; ?></h2>
    <hr>

    <div class="container product-container mt-3 mb-5 d-flex flex-column align-items-center w-70">

        <div class="col-12 d-flex justify-content-center">
            <img class="img-fluid" style="max-width: 800px; min-width: 600px;" src="<?php echo $project['picture']; ?>" alt="<?php echo $project['title']; ?>">
        </div>
        <div class="col-8 d-flex flex-column amign-items-center">
            <h3 class="project-h3"><?php echo $project['chapo']; ?></h3>
            <p class="language-text mb-3">Langages utilisés : <?php echo $project['language']; ?></p>
            <div class="description-text mt-5 mb-5 pb-5"><?php echo $project['description']; ?></div>
        </div>
        <div class="col-4 d-flex justify-content-center">
            <a href="<?= URL ?>projects_list.php" class="btn btn-registrar back-2-projects px-4">Retour aux projets</a>
        </div>
    </div>

    <?php
    require_once './inc/footer_inc.php';
    ?>