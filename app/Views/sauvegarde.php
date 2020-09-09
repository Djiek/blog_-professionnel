<?php
//  $form = new Form(isset($_SESSION['inputs']) ? $_SESSION['inputs'] : []); 
// $form = new FormController;
// $forms->formModel();
?>
<div class="row">
    <?= $forms->text('name', 'Nom : '); ?>
</div>
<div class="row">
    <?= $forms->text('firstname', 'Prénom : '); ?>
</div>
<div class="row">
    <?= $forms->email('email', 'Mail : '); ?>
</div>
<div class="row">
    <?= $forms->textarea('message', 'Votre Message : '); ?>
</div>
<button type="submit" class="btn btn-primary"> Envoyer </button>
</form>