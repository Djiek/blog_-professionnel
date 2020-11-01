<?php

$title = 'Mon blog'; ?>

<?php ob_start();
?>
<?php
foreach ($posts as $post) :
?>
    <br /><br />
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card border-primary mb-3" style="max-width: 50rem;">
                <form action="index.php?action=modifyBlogPost&id=<?= $post->getId() ?>" method="post">
                    <h2 class="bordure">Modifier un blog post</h2>
                    <div class="form-group  bordure">
                        <label for="title">Titre : </label>
                        <input value=" <?= htmlspecialchars($post->getTitle()) ?>" type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="form-group  bordure">
                        <label for="chapo">Chapô : </label>
                        <input value="<?= htmlspecialchars($post->getChapo()) ?>" type="text" name="chapo" class="form-control" id="chapo">
                    </div>
                    <div class="form-group  bordure">
                        <label for="content">Contenu : </label>
                        <textarea name="content" class="form-control" id="content" rows="3"><?= htmlspecialchars($post->getContent()) ?></textarea>
                    </div>
                    <div class="bordure"> <button type="submit" class="btn btn-primary"> Modifier </button></div>
                </form>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
<?php endforeach ?>
<?php
?>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>