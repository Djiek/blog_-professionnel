<?php
$title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Ajouter un blog post</h1>

<h1> Le blogPost a été enregistré en base de donnée</h1>
<a class="nav-link" href="index.php?action=home">Retourner à la page d'accueil <span class="sr-only">(current)</span></a>
<?php

// $posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>