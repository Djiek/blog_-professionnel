<?php

$title = 'Mon blog'; ?>

<?php ob_start();
?> 

<br /><br />
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-primary mb-3" style="max-width: 50rem;">
            <form action="index.php?action=addBlogPost" method="post">
                <fieldset>
                    <h2 class="bordure">Ajouter un blog post</h2>
                    <div class="form-group  bordure">
                        <label for="title">Titre : </label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="form-group  bordure">
                        <label for="chapo">Chapô : </label>
                        <input type="text" name="chapo" class="form-control" id="chapo">
                    </div>
                    <div class="form-group  bordure">
                        <label for="content">Contenu : </label>
                        <textarea name="content" class="form-control" id="exampleTextarea" rows="3"></textarea>
                    </div>
                    <div class="bordure"> <button type="submit" class="btn btn-primary"> Envoyer </button></div>
            </form>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>

<?php
// $posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>