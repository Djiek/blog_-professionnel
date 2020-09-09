<?php
$title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Ajouter un commentaire</h1>

<h1> Votre commentaire a été pris en compte et sera traité par un administrateur dans les meilleurs délais. </h1>
<a class="nav-link" href="index.php?action=listPosts">Retourner à la liste des blogPosts <span class="sr-only">(current)</span></a>
<?php

// $posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>