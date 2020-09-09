<?php
$title = 'Inscription'; ?>

<?php ob_start(); ?>
<br /><br />
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-primary mb-3" style="max-width: 50rem;">
            <form action="index.php?action=inscription" method="post">
                <fieldset>
                    <h2 class="bordure">Veuillez remplir le formulaire :</h2>
                    <div class="form-group  bordure">
                        <p>Login</p><input type="login" name="login" /> <br />
                    </div>
                    <div class="form-group  bordure">
                        <p> Mot de passe </p> <input type="password" name="password" /><br /><br />
                    </div>
                    <div class="form-group  bordure">
                        <p>Confirmation du mot de passe </p> <input type="password" name="cPassword" /><br /><br />
                    </div>
                    <div class="form-group  bordure">
                        <p>Mail </p> <input type="email" name="mail" /><br /><br />
                    </div>
                    <div class="bordure"> <button type="submit" class="btn btn-primary"> Enregistrer </button></div>
            </form>
        </div>
    </div>
</div>
<div class="col-sm-2"></div>


<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>