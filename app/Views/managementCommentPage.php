<?php
$title = 'Mon blog';
?>

<?php ob_start();
?>
<br />

<div class="row bordure">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-success mb-3" style="max-width: 50rem;">
            <h2 class="bordure">gestion des commentaires :</h2>
            <?php
            foreach ($comments as $comment) :
            ?>
                <div class="row bordureCom">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="card border-success mb-3 ">
                            <label for="title"> Par <?= $comment->getUserId(); ?>, le <?= $comment->getDate()  ?> </label>
                            <h4 class="table-success"><?= htmlspecialchars(($comment->getTitle())) ?> </h4>
                            </label>
                            <div class="card-text bordureCom  ">
                                <label for="content"> <?= nl2br(htmlspecialchars(($comment->getContent()))); ?></label>
                            </div>
                            <div class="card-text bordureCom  ">
                                <p class="card-text"><em><a href="index.php?action=ViewPostComment&id=<?= $comment->getBlogPostId() ?>">Voir le blog post associé </a></em></p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div> <br />
                </div>
                </div>
            <?php
            endforeach;
            ?>
            <div>
                <ul class="pagination pagination-sm">
                    <?php for ($i = 1; $i <= $pageOfNumber; $i++) { ?>
                        <li class="page-item active">
                            <a class="page-link" href="index.php?action=managementCommentPage&page=<?= $i ?>"><?php echo $i  ?></a>
                        <?php } ?>
                        </li>
                </ul>
            </div>
            </div>
            <?php $content = ob_get_clean(); ?>
            <?php require 'template.php'; ?>