<?php
$title = 'Mon blog'; ?>

<?php ob_start();
?>

<div class="row paddingA ">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-primary mb-3" style="max-width: 50rem;">
            <form action="index.php?action=login" method="POST">
                <h2 class="bordure">Veuillez entrer vos iddentifiants pour vous connecter :</h2>
                <div class="form-group  bordure">
                    <p>Login</p><input type="text" name="login" /> <br>
                </div>
                <div class="form-group  bordure">
                    <p> Mot de passe </p> <input type="password" name="password" /><br><br>
                </div>
                <div class="bordure"> <button type="submit" class="btn btn-primary"> Valider </button></div>
                <div><a class="nav-link" href="index.php?action=inscriptionForm"> Vous n'avez pas encore de compte ? Inscrivez vous en cliquant ici.</a></div>
            </form>
        </div>
    </div>
</div>
<div class="col-sm-2 paddingA"></div>

<?php $content = ob_get_clean(); ?>
<?php require 'template.php'; ?>