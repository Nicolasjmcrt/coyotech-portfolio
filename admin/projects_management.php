<?php

require_once '../inc/init.php';
require_once '../inc/admin_head_inc.php';

// var_dump($connect);

?>

<title>CoyoTech Admin | Gestion des projets</title>
</head>

<body>

    <?php

    $error = '';

    $viewReq = $connect->query("SELECT * FROM project ORDER BY project_id DESC");

    $projects = $viewReq->fetchAll(PDO::FETCH_ASSOC);

    if ($_POST) {

        // foreach ($_POST as $key => $value) {
        //     $_POST[$key] = htmlspecialchars(addslashes($value));
        // }

        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            $dbImg = $_POST['actual-picture'];
        }

        $title = addslashes($_POST['title']);
        $chapo = addslashes($_POST['chapo']);
        $description = addslashes($_POST['description']);
        $language = addslashes($_POST['language']);

        // var_dump($title);
        // var_dump($chapo);
        // var_dump($description);
        // var_dump($language);


        $req = $connect->query("SELECT * FROM project WHERE title = '$title'");
        $state = $req->rowCount();


        // ----------AJOUT IMAGE---------

        if (!empty($_FILES['picture'])) {

            $picture = $_FILES['picture'];

            $imgName = time() . '_' . rand() . '_' . $picture['name'];

            $dbImg = URL . "img/$imgName";

            define("BASE", $_SERVER['DOCUMENT_ROOT'] . '/coyotech/');

            $imgFile = BASE . "img/$imgName";

            if ($picture['size'] <= 8000000) {

                $info = pathinfo($picture['name'], PATHINFO_EXTENSION);

                $tabExt = ['jpg', 'png', 'jpeg', 'gif', 'webp', 'JPG', 'PNG', 'JPEG', 'GIF', 'WEBP', 'Jpg', 'Png', 'Jpeg', 'Gif', 'Webp'];

                if (in_array($info, $tabExt)) {
                    copy($picture['tmp_name'], $imgFile);
                } else {
                    $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
                    Ce format d\'image n\'est pas autorisé !
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            } else {
                $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
                Vérifier la taille de votre image (8Mo max) !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }

        // --------------------------VÉRIFICATION SI UPDATE OU INSERT INTO--------------------------------

        if (isset($_GET['action']) && $_GET['action'] == 'edit') {

            $connect->query("UPDATE project SET title = '$title',
                                                chapo = '$chapo',
                                                description = '$description',
                                                picture = '$dbImg',
                                                language = '$language' WHERE project_id = '$_GET[project_id]'");

            $error .= '<div class="alert alert-dismissible fade show alert-success" role="alert">
            Le projet a été modifié !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

            header('location:projects_management.php');
        } else {

            // --------------------------VÉRIFICATION DES INPUTS--------------------------------

            // Vérification si référence déjà existante
            if ($state >= 1) {
                $error = '<div class="alert alert-dismissible fade show alert-danger" role="alert">Ce titre de projet existe déjà !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }

            if (empty($title)) {
                $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Vous devez saisir un titre !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }

            if (empty($chapo)) {
                $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Vous devez saisir un chapo !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }

            if (empty($description)) {
                $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Vous devez décrire votre projet !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }

            if (empty($_FILES['picture'])) {
                $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Vous devez sélectionner l\'image de votre projet !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }

            if (empty($language)) {
                $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Vous devez indiquer les langages de votre projet !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }

            if (empty($error)) {
                $connect->query("INSERT INTO project(title, chapo, description, picture, language) VALUES('$title','$chapo','$description','$dbImg','$language')");

                var_dump($dbImg);


                $error .= '<div class="alert alert-dismissible fade show alert-success" role="alert">
                Le projet a été ajouté !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                header('location:projects_management.php');
            }
        }

        $alert .= $error;
    }

    ?>





    <?php

    require_once '../inc/header_inc.php';

    if (!userConnected()) {
        header('location:../index.php');
    }

    ?>
    <h1 class="text-center home-h1 mt-3">Admin | Gestion des projets</h1>
    <p class="text-center mt-3 mb-3 home-p">Ajouter un projet</p>
    <div class="container mt-3 mb-3">
        <?= $alert; ?>
    </div>
    <hr>
    <div class="container mt-3">

        <?php

        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            $connect->query("DELETE FROM project WHERE project_id = '$_GET[project_id]'");

            header('location:projects_management.php');
        }

        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            $edit = $connect->query("SELECT * FROM project WHERE project_id = '$_GET[project_id]'");

            $data = $edit->fetch(PDO::FETCH_ASSOC);
        }

        $pId = (isset($data['project_id'])) ? $data['project_id'] : '';
        $tit = (isset($data['title'])) ? $data['title'] : '';
        $cha = (isset($data['chapo'])) ? $data['chapo'] : '';
        $des = (isset($data['description'])) ? $data['description'] : '';
        $pic = (isset($data['picture'])) ? $data['picture'] : '';
        $lan = (isset($data['language'])) ? $data['language'] : '';

        ?>

        <div class="table-responsive">
            <table class="table table-light align-middle table-hover caption-top">
                <caption>Liste des projets</caption>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID du projet</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Chapo</th>
                        <th scope="col">Image</th>
                        <th scope="col">Langage</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project) { ?>
                        <tr>
                            <th scope="row" class="align-middle"><?php echo $project['project_id']; ?></th>
                            <td class="align-middle"><?php echo $project['title']; ?></td>
                            <td class="align-middle text-truncate" style="max-width: 150px"><?php echo $project['chapo']; ?></td>
                            <td class="align-middle"><img src="<?php echo $project['picture']; ?>" style="width:100px;"></td>
                            <td class="align-middle"><?php echo $project['language']; ?></td>
                            <td class="align-middle"><a href="?action=edit&project_id=<?php echo $project['project_id']; ?>"><i class="bi bi-pencil-fill text-warning"></i></a></td>
                            <td class="align-middle"><a href="?action=delete&project_id=<?php echo $project['project_id']; ?>"><i class="bi bi-trash-fill text-danger"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mt-3 pb-5 mb-5">
        <?php if (!empty($pic)) : ?>
            <div class="d-flex justify-content-center mt-3 mb-3">
                <img src="<?= $pic; ?>" style="max-width:300px;">
            </div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data" class="pb-5 mb-5">
            <input type="hidden" name="project_id" name="project_id" value="<?= $pId ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Titre du projet</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" value="<?= $tit ?>">
            </div>
            <div class="mb-3">
                <label for="chapo" class="form-label">Chapo du projet</label>
                <textarea name="chapo" id="chapo" rows="3" class="form-control"><?= $cha ?></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description du projet</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= $des ?></textarea>
                <script>
                    CKEDITOR.replace('description');
                </script>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Image principale du projet</label>
                <input class="form-control" name="picture" type="file" id="picture">
            </div>
            <div class="mb-3">
                <label for="language" class="form-label">Langage utilisé pour le projet</label>
                <input type="text" name="language" class="form-control" id="language" value="<?= $lan ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-registrar">Ajouter</button>
        </form>

    </div>
    <?php
    require_once '../inc/footer_inc.php';
    ?>