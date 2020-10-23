<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="public/css/css.css">
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='public/css/bootstrap/bootstrap.min.css' />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?action=home">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=listPosts">Liste des blogs Posts</a>
                </li>
                <?php if (isset($_SESSION['User'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=logout">Se déconnecter</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=connection">Se connecter</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=addPostForm">Ajouter un blog post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=managementCommentPage">Gestion des commentaires</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <?= $content ?>
    <?php if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['flash']['success'])) {
        echo "<h3 class='table-success bordure'>" . $_SESSION['flash']['success'] . "</h3>";
        unset($_SESSION['flash']['success']);
    } ?>
</body>

</html>