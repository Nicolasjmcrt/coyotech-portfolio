<header class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-blue">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CoyoTech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= URL ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>about.php">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>projects_list.php">Projets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://coyotech.fr/blog-mvc/">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>#contact">Contact</a>
                    </li>
                    <?php if (userConnected()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>registration.php">S'inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>admin/projects_management.php">Ajouter un projet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>authentication.php?action=logout">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?= URL ?>authentication.php">Se connecter</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
</header>