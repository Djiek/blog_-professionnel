<?php
$title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1 class="bordure"> Le blogPost a été enregistré en base de donnée</h1>
<a class="nav-link bordure" href="index.php?action=home">Retourner à la page d'accueil <span class="sr-only">(current)</span></a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>