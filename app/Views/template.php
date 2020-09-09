<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="public/css/css.css">
    <link rel='stylesheet' href='public/css/bootstrap/bootstrap.min.css' />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?action=home">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=listPosts">Liste des blogs Posts</a>
                </li>
                <?php if (isset($_SESSION['login']) and isset($_SESSION['mail'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=connection">Se déconecter</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=connection">Se connecter</a>
                    </li>

                <?php  } ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=addPostForm">Ajouter un blog post</a>
                </li>
            </ul>
        </div>
    </nav>



    <?= $content ?>
</body>

</html>