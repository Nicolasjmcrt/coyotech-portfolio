<?php

require_once './inc/init.php';
require_once './inc/head_inc.php';

// var_dump($connect);
?>

<title>CoyoTech | Liste des projets</title>
</head>

<body>


    <!--------------TRAITEMENT--------------->

    <?php



    $error = '';

    $viewReq = $connect->query("SELECT * FROM project ORDER BY project_id DESC");

    $projects = $viewReq->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <?php
    require_once './inc/header_inc.php';
    ?>

    <h1 class="text-center home-h1 mt-4">CoyoTech | Liste des projets</h1>
    <hr>
    <div class="col-12 mb-5 mt-5 d-flex justify-content-center flex-wrap">

        <?php foreach ($projects as $project) { ?>
            <div class="col-8 d-flex justify-content-center">
                <div class="card card-list mb-5" style="max-width: 1000px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $project['picture']; ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8 proj-list-body">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $project['title']; ?></h5>
                                <p class="card-text"><?php echo $project['chapo']; ?></p>
                                <p class="card-text"><small class="text-small"><?php echo $project['language']; ?></small></p>
                                <a href="<?= URL ?>project_view.php?project=<?php echo $project['project_id']; ?>" class="btn btn-registrar">Voir le projet</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>






    <?php
    require_once './inc/footer_inc.php';
    ?>