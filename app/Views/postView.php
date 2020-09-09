<?php
ob_start();
$title = htmlspecialchars($post['title']); ?>
<h1><br /></h1>
<div class="row news">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-primary mb-3" style="max-width: 50rem;">
            <h3 class="bordure card-header ">
                <?= htmlspecialchars($post['title']) ?> <!--$post->getTitle()-->
                <em>le <?= $post['dateLastModification'] ?></em>
                <p>auteur : <?= nl2br(htmlspecialchars($post['login'])) ?></p>
            </h3>
            <div class="card-body">
                <p class="bordure card-title">
                    <?= nl2br(htmlspecialchars($post['chapo'])) ?>

                </p>
                <p class="bordure card-text">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row bordure">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-success mb-3 bordure" style="max-width: 50rem;">
            <h2 class="bordure">Commentaires :</h2>
            <?php
            while ($comment = $comments->fetch()) {
            ?>
                <div class="row bordureCom">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class=" card text-white bg-success mb-3 bordure">
                            <label for="title"> Par <?= htmlspecialchars($comment['login']) ?> </label>

                            <div class="card-header bordureCom">
                                <div class="bordure card-body">Le <?= $comment['date']  ?> </div>
                                <h4 class="bordureCom card-title"><?= nl2br(htmlspecialchars($comment['title'])) ?> </h4>
                                </label>
                                <div class="card-text bordureCom">
                                    <label for="content"> <?= nl2br(htmlspecialchars($comment['content'])); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>

            <div>
                <ul class="pagination pagination-sm">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">&laquo;</a>
                    </li>
                    <?php for ($i = 1; $i <= $pageOfNumber; $i++) { ?>
                        <li class="page-item active">
                            <a class="page-link" href="index.php?action=post&id=<?= $post['id'] ?>&page=<?= $i ?>"><?php echo $i  ?></a>
                        <?php } ?>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">&raquo;</a>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<br /><br />
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-primary mb-3" style="max-width: 50rem;">
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <fieldset>
                    <h2 class="bordure">Ajouter un commentaire</h2>
                    <div class="form-group  bordure">
                        <label for="title">Titre du commentaire : </label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="form-group  bordure">
                        <label for="content">Commentaire : </label>
                        <textarea name="content" class="form-control" id="exampleTextarea" rows="3"></textarea>
                    </div>
                    <div class="bordure"> <button type="submit" class="btn btn-primary"> Envoyer </button></div>
            </form>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>