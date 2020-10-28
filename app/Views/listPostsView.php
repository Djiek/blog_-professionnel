<?php

$title = 'Mon blog'; ?>
<?php ob_start();
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['flash']['success'])) {
    echo "<h3 class='table-success bordure'>" . $_SESSION['flash']['success'] . "</h3>";
    unset($_SESSION['flash']['success']);
} ?>


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
foreach ($posts as $post) :
?>
    <div class="container ">
        <div class="row listpost ">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <div class="news">
                    <div class="card bg-light mb-3" style="max-width: 40rem;">
                        <div class="card-header ">
                            <h4 class="textBlogPost"> <?= htmlspecialchars($post->getTitle()) ?></h4>
                            <em>le <?= $post->getDate() ?></em>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title textBlogPost"><?= htmlspecialchars($post->getChapo()) ?></h5>

                            <p class="card-text"><em><a href="index.php?action=post&id=<?= $post->getId() ?>">Voir le blog post en entier</a></em></p>
                            <?php if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) : ?>
                                <a class="btn btn-primary mb-2" href="index.php?action=postModify&id=<?= $post->getId() ?>"> Modifier</a><br />
                                <a onClick="return confirm('Voulez-vous vraiment supprimer ce post ?')" href="index.php?action=postDelete&id=<?= $post->getId() ?>" class="btn btn-primary"> Supprimer</a><br />
                                </form><?php endif ?>
                        </div>
                    </div><br />
                </div>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>

<?php endforeach;

?>
<div>
    <ul class="pagination pagination-sm">

        <?php for ($i = 1; $i <= $pageOfNumber; $i++) { ?>
            <li class="page-item active">
                <?php echo  "<a class=\"page-link\" href='index.php?action=listPosts&page=$i'>$i</a>"  ?>
            <?php } ?>
            </li>
    </ul>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>