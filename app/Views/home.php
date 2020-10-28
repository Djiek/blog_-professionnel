<?php

$title = 'Mon blog'; ?>

<?php ob_start();
if (isset($_SESSION['flash']['success'])) {
    echo "<h3 class='table-success bordure'>" . $_SESSION['flash']['success'] . "</h3>";
    unset($_SESSION['flash']['success']);
}
?>


<div class= "paddingB">
    <?php if (isset($_SESSION['User'])) : ?>
        <h3 class="bordure"> Bienvenue <?php echo $_SESSION['User']['login']; ?>
        <?php endif; ?>

        </h3>
        <header>

            <p id="nom" class="color">
                Marine Richini
            </p>

            <h4> Une Développeuse faite pour votre entreprise ! </h4>
            <img src="public/image/photocv.PNG" alt="photo-cv">

            <p> Permis B -
                Tourcoing </p>
            <p>
                <a href="https://www.linkedin.com/in/marine-richini-791149194/">
                    <img src="public/image/linkedIn.png" height="50" width="50" alt="logo-linkedIn" /></a>

                <a href="https://github.com/Djiek">
                    <img src="public/image/github.png" height="50" width="50" alt="logo-linkedIn" /></a>
            </p>

            <a href="public/image/cv.pdf" download="cv.pdf">Telecharger mon Cv</a>
        </header>
</div>

<div class="container">
    <h3 class="titre"> Mes expériences professionnelles</h3>
    <ul>

        <li class= "paddingB"><U>Novembre 2019 à fevrier 2020</U>
            <span class="color"> Stage Developpeur Web</span><br>
            Groupe Cerise - Tourcoing (59)<br>
            Base de données nosql, php, angular,methode agile(SCRUM)
        </li>


        <li class= "paddingB"><U>Juin 2018</U>
            <span class="color"> Agent de production</span><br>
            Mission d'intérim : Usine Château Blanc - Marcq-en-Baroeul (59)<br>
            Emballage des produits, nettoyage, mise en boite des macarons, étiquetages, etc.
        </li>


        <li class= "paddingB" ><U>Mars à avril 2016</U>
            <span class="color"> Restauration collective</span><br>
            Mission d'intérim : Sovitrat - Lille (59) <br>
            Préparation des recettes, préparation des entrée et dessert sur assiette.
        </li>


        <li class= "paddingB"><U>Juillet à septembre 2015</U>
            <span class="color">Employée polyvalente </span><br>
            Station Shell - Briis-sous-forges (91)<br>
            Caisse, mise en rayon des produits, nettoyage des machines à café.
        </li>


        <li class= "paddingB" ><U>Octobre 2013 à octobre 2014</U>
            <span class="color"> Médiatrice culturelle </span> <br>
            Compagnie du Tire Laine - Lille (59) <br>
            Préparation du lieu et des repas des artistes en vue des concerts. Remise à jour des fichiers de contact pour les chargés de diffusion.<br>
            Pose d'affiches et de flyers en vue des spectacles et festivals de la compagnie.
        </li>


        <li class= "paddingB"><U>Août à septembre 2013</U>
            <span class="color"> Restauration scolaire </span><br>
            Mairie de Lille (59)<br>
            Préparation des commandes et plats pour les enfants, instalation des tables, nettoyage de la vaisselle et du laboratoire.
        </li>

        <li class= "paddingB"><U>De juillet 2006 à août 2009</U>
            <span class="color"> Apprentie en pâtisserie et glacerie </span><br>
            Westminster Hôtel et Veron Chocolatier - Le Touquet Paris Plage <br>
            Conception d'entremets, décors en chocolat, biscuits, pâte à choux, tartes, glaces et sorbets, entremets glacés, etc,...
        </li>
    </ul>

    <h3 class="titre">
        Diplômes et formations
    </h3>

    <div class= "paddingB bordure">
        <p><U> Mai 2019 à novembre 2019</U>
            <span class="color">Formation développeur web et web mobile avec diplome obtenu</span>
            Formation Afpa de Roubaix (59)
            Développer la partie front-end d'une application web et développer la partie back-end d'une application web.
        </p>

        <p> <U> Année 2011</U>
            <span class="color">Mention complémentaire pâtisserie obtenue</span>
            CFA Arras (62)
        </p>

        <p><U> Année 2010</U>
            <span class="color">CAP Glacerie obtenu </span>
            CFA Arras (62)
        </p>

        <p><U> Année 2009</U>
            <span class="color">BEP pâtisserie obtenu </span>
            CFA Boulogne sur Mer (62)
        </p>

        <p><U> Année 2005 à 2007</U>
            <span class="color">Seconde et première STG communication</span>
            Lycée Jean Lavezzari de Berck sur Mer (62)
        </p>
    </div>

    <h3 class="titre">
        Bénévolat, wwoofing et centre d'intérêt Diplômes et formations
    </h3>

    <ul class= "paddingB">
        <li> <U>De 2017 à 2018 </U><br>
            <span class="color"> Intervenante(cuisine)</span><br>
            Association K-Pa-Cité - Roubaix (59) <br>
            Cours de pâtisserie avec les jeunes de l'association. Accompagnement sur les événements pour réaliser les repas.
        </li>
        <li> <U> De 2015 à 2018 </U><br>
            <span class="color"> Catering </span><br>
            La Malterie, La Cave aux Poetes et la Condition Publique - Lille- Roubaix (59)<br>
            Préparation des repas avant les concerts via l'association Tourne Disque.
        </li>
        <li> <U> Avril 2017</U><br>
            <span class="color"> Wwoofing Suède</span><br>
            3 semaines dans une ferme biologique <br>
            Plantation de légumes en serre et en ext&#233;rieur, entretient des fraisiers, soin des animaux (nourriture, eau, paille, etc,..)
        </li>
        <li><U> Novembre 2016 </U><br>
            <span class="color"> Wwoofing Canada</span><br>
            1 mois dans une ferme biologique <br>
            Elagage des haies et ronces, plantation d'ails, soin des animaux (nourriture, eau,paille, etc,...)
        </li>
    </ul>

    <div id="loisir">
        <h2>Loisirs</h2>

        Lecture. Chant et piano dans un groupe de pop astral (Kiwi Astral)

    </div>
    <p  class= "paddingB"> </p>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card border-primary mb-3" style="max-width: 50rem;">
                <form action="index.php?action=postContact" method="post">
                    <fieldset>
                        <h4 class="bordure"> Si vous avez des questions, n'hésitez pas à me contacter via ce formulaire.</h4>
                        <div class="form-group  bordure">
                            <label for="name">Nom : </label>
                            <input type="text" name="name" class="form-control" id="name" required="required">
                        </div>
                        <div class="form-group  bordure">
                            <label for="firstname">Prénom : </label>
                            <input type="text" name="firstname" class="form-control" id="firstname" required="required">
                        </div>
                        <div class="form-group  bordure">
                            <label for="email">Mail :</label>
                            <input type="email" name="email" class="form-control" id="email" required="required">
                        </div>
                        <div class="form-group  bordure">
                            <label for="message">Votre message : </label>
                            <textarea name="message" class="form-control" id="message" rows="3" required="required"></textarea>
                        </div>
                        <div class="bordure"> <button type="submit" class="btn btn-primary"> Envoyer </button></div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'template.php'; ?>