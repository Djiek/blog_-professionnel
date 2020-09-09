<?php
// $_SESSION['user'] =[
// 'login'=>$login,

// ];

// session_unset();
// session_destroy();

$title = 'Mon blog'; ?>
<link rel="stylesheet" type="text/css" href="public/css/css.css">
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>

<?php var_dump($_SESSION['login']); ?>


<div>
    <br/>
   <?php if (isset($_SESSION['login']) AND isset($_SESSION['mail']))
{   ?> <h3> Bienvenue <?php echo $_SESSION['login']; }
         ?>
    
     </h3>
    <header>

        <strong>
            <div id="nom">
                <font color=#263f3f>Marine Richini<br /><br /></font>
            </div>
            <!--le nom en dehors du tableau pour etre placé de l'autre côté-->
        </strong>
        <h4> Une Développeuse faite pour votre entreprise ! </h4>
        <img src="public/image/photocv.PNG" alt="photo-cv">
        <p>
            <!--tableau pour les infos-->

            <p> Permis B -
                Tourcoing </p>
            <p>
                <a href="https://www.linkedin.com/in/marine-richini-791149194/">
                    <img src="public/image/linkedIn.png" height="50" width="50" alt="logo-linkedIn" /></a>

                <a href="https://github.com/Djiek">
                    <img src="public/image/github.png" height="50" width="50" alt="logo-linkedIn" /></a>
            </p>
        </p><br />
        <a href="public/image/cv.pdf" download="cv.pdf">Telecharger mon Cv</a>
    </header>
</div>




<div class="container">
    <strong>
        <div id="titre">
            <FONT color=#263f3f>
                <h3> Mes expériences professionnelles</h3>
        </div>
        </font><br />
        <!--fonction de couleur avec font sur les titres-->
        <br /> <br /> <br />

        <ul>

            <li><U>Novembre 2019 à fevrier 2020 </U>
                <FONT color=#01796F size="3pt"> Stage Developpeur Web</font><br />
                Groupe Cerise - Tourcoing (59)<br />
                Base de données nosql, php, angular,methode agile(SCRUM)
            </li><br /><br />


            <li><U>Juin 2018</U>
                <FONT color=#01796F size="3pt"> Agent de production</font><br />
                Mission d'intérim : Usine Château Blanc - Marcq-en-Baroeul (59)<br />
                Emballage des produits, nettoyage, mise en boite des macarons, étiquetages, etc.
            </li><br /><br />


            <li><U>Mars à avril 2016</U>
                <FONT color=#01796F size="3pt"> Restauration collective</font><br />
                Mission d'intérim : Sovitrat - Lille (59) <br />
                Préparation des recettes, préparation des entrée et dessert sur assiette.
            </li><br /><br />


            <li><U>Juillet à septembre 2015</U>
                <FONT color=#01796F size="3pt">Employée polyvalente </font><br />
                Station Shell - Briis-sous-forges (91)<br />
                Caisse, mise en rayon des produits, nettoyage des machines à café.
            </li><br /><br />


            <li><U>Octobre 2013 à octobre 2014</U>
                <FONT color=#01796F size="3pt"> Médiatrice culturelle </font> <br />
                Compagnie du Tire Laine - Lille (59) </br>
                Préparation du lieu et des repas des artistes en vue des concerts. Remise à jour des fichiers de contact pour les chargés de diffusion.<br />
                Pose d'affiches et de flyers en vue des spectacles et festivals de la compagnie.
            </li><br /><br />


            <li><U>Août à septembre 2013</U>
                <FONT color=#01796F size="3pt"> Restauration scolaire </font><br />
                Mairie de Lille (59)<br />
                Préparation des commandes et plats pour les enfants, instalation des tables, nettoyage de la vaisselle et du laboratoire.
            </li><br /><br />

            <li><U>De juillet 2006 à août 2009</U>
                <FONT color=#01796F size="3pt"> Apprentie en pâtisserie et glacerie </font><br />
                Westminster Hôtel et Veron Chocolatier - Le Touquet Paris Plage <br />
                Conception d'entremets, décors en chocolat, biscuits, pâte à choux, tartes, glaces et sorbets, entremets glacés, etc,...
            </li><br /><br />
        </ul>
    </strong>



    <strong>
        <div id="titre">
            <h3>
                <FONT color=#263f3f> Diplômes et formations
            </h3>
        </div>
        </font><br /> <!-- un id pour que mes titres soient ensemble-->
        <div id="texteCache2">
            <center>
                <p><U> Mai 2019 à novembre 2019</U><br /><br />
                    <FONT color=#01796F size="3pt">Formation développeur web et web mobile avec diplome obtenu</font><br /><br />
                    Formation Afpa de Roubaix (59) <br />
                    Développer la partie front-end d'une application web et développer la partie back-end d'une application web.<br /><br /><br />
                </p>

                <p> <U> Année 2011</U> <br /><br />
                    <FONT color=#01796F size="3pt">Mention complémentaire pâtisserie obtenue</font><br /><br />
                    CFA Arras (62) </br><br /><br />
                </p>

                <p><U> Année 2010</U><br /><br />
                    <FONT color=#01796F size="3pt">CAP Glacerie obtenu </font><br /><br />
                    CFA Arras (62) <br /><br /><br />
                </p>

                <p><U> Année 2009</U><br /><br />
                    <FONT color=#01796F size="3pt">BEP pâtisserie obtenu </font><br /><br />
                    CFA Boulogne sur Mer (62) <br /><br /><br />
                </p>

                <p><U> Année 2005 à 2007</U><br /><br />
                    <FONT color=#01796F size="3pt">Seconde et première STG communication</font><br /><br />
                    Lycée Jean Lavezzari de Berck sur Mer (62) <br /><br />
                </p>
            </center>
        </div>

    </strong>



    <p>
        <strong>
            <div id="titre">
                <h3>
                    <FONT color=#263f3f> Bénévolat, wwoofing et centre d'intérêt
                </h3>
            </div>
            </font></br><br />

            <ul>
                <li> <U>De 2017 à 2018 </U><br />
                    <FONT color=#01796F size="3pt"> Intervenante(cuisine)</font><br />
                    Association K-Pa-Cité - Roubaix (59) <br />
                    Cours de pâtisserie avec les jeunes de l'association. Accompagnement sur les événements pour réaliser les repas. <br /><br />
                </li>
                <li> <U> De 2015 à 2018 </U><br />
                    <FONT color=#01796F size="3pt"> Catering </font><br />
                    La Malterie, La Cave aux Poetes et la Condition Publique - Lille- Roubaix (59)<br />
                    Préparation des repas avant les concerts via l'association Tourne Disque.<br /><br />
                </li>
                <li> <U> Avril 2017</U><br />
                    <FONT color=#01796F size="3pt"> Wwoofing Suède</font><br />
                    3 semaines dans une ferme biologique <br />
                    Plantation de légumes en serre et en ext&#233;rieur, entretient des fraisiers, soin des animaux (nourriture, eau, paille, etc,..) <br /><br />
                </li>
                <li><U> Novembre 2016 </U><br />
                    <FONT color=#01796F size="3pt"> Wwoofing Canada</font><br />
                    1 mois dans une ferme biologique <br />
                    Elagage des haies et ronces, plantation d'ails, soin des animaux (nourriture, eau,paille, etc,...) <br /><br />
                </li>
            </ul>

            <div id="loisir">
                <U>
                    <FONT color=#263f3f size="5pt"> Loisirs
                </U></font></br></br>

                Lecture. Chant et piano dans un groupe de pop astral (Kiwi Astral)

            </div>
        </strong>
    </p><br /><br />

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card border-primary mb-3" style="max-width: 50rem;">
                <form action="index.php?action=postContact" method="post">
                    <fieldset>
                        <h4 class="bordure"> Si vous avez des questions, n'hésitez pas à me contacter via ce formulaire.</h4>
                        <div class="form-group  bordure">
                            <label for="name">Nom : </label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group  bordure">
                            <label for="firstname">Prénom : </label>
                            <input type="text" name="firstname" class="form-control" id="firstname">
                        </div>
                        <div class="form-group  bordure">
                            <label for="email">Mail :</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group  bordure">
                            <label for="message">Votre message : </label>
                            <textarea name="message" class="form-control" id="exampleTextarea" rows="3"></textarea>
                        </div>
                        <div class="bordure"> <button type="submit" class="btn btn-primary"> Envoyer </button></div>
                </form>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>