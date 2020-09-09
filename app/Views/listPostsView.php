<?php

$title = 'Mon blog'; ?>
<?php ob_start(); ?>


<div class="container ">
    <div class="row "><br />
    </div>
    <div class="row listpost ">
        <div class="col-sm-1"></div>
        <div class="col-sm-9">
            <h3>Les posts :</h3><br />
        </div>
    </div>
</div>
<?php
while ($data = $posts->fetch()) {
?>
    <div class="container ">
        <div class="row listpost ">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <div class="news">
                    <div class="card text-white bg-secondary mb-3" style="max-width: 40rem;">
                        <div class="card-header ">
                            <h4 class="textBlogPost"> <?= htmlspecialchars($data['title']) ?></h4>
                            <em>le <?= $data['dateLastModification'] ?></em>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title textBlogPost"><?= htmlspecialchars($data['chapo']) ?></h5>

                            <p class="card-text"><em><a href="index.php?action=post&id=<?= $data['id'] ?>">Voir le blog post en entier</a></em></p>
                        </div>
                    </div><br />
                </div>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>

<?php

}
$posts->closeCursor();
?>
<div>
    <ul class="pagination pagination-sm">
        <li class="page-item disabled">
            <a class="page-link" href="#">&laquo;</a>
        </li>
        <?php for ($i = 1; $i <= $pageOfNumber; $i++) { ?>
            <li class="page-item active">
                <?php echo  "<a class=\"page-link\" href='index.php?action=listPosts&page=$i'>$i</a>"  ?>
            <?php } ?>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">&raquo;</a>
            </li>
    </ul>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>