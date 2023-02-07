<?php
require '../template/head.php';
require '../template/header.php';
require '../template/footer.php';
require_once '../origin_path.php';
$title = "Todo list de classe";
$desc = "Application de cahier de texte collectif pour ta classe. Crée une nouvelle classe ou rejoint-en une existante.";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?= getHead($title, $desc) ?>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?= getHeader($title) ?>
<main class="">
    <section class="b-darken">
        Cette application en ligne propose un cahier de texte collectif pour ta classe. Chaque membre peut ajouter des tâches à faire, puis tous les autres verront les devoirs à venir !
        <br>
        Tu peux rejoindre une classe existante en inscrivant ton email INSA et en cliquant sur le lien de vérification. Les membres de la classe pourront ensuite t'accepter et tu auras accès à la liste des tâches.
    </section>

    <section class="b-darken">
        <h3>Classes déjà présentes :</h3>
        <p>
            <?php
            require_once 'db.php';
            $classes = $db->query('SELECT name FROM classes');
            foreach ($classes as $class) {
                echo '<span>'.$class['name'].'</span>&nbsp;';
            }
            ?>
        </p>
    </section>

    <section class="b-darken">
        <h3>Authentification</h3>
        <form action="<?= getRootPath() ?>todo/auth" method="post">
            <label for="email">Email INSA&#8239;:</label><br/>
            <input type="text" name="email" id="email" required><span style="font-size: 14px">@insa-lyon.fr</span><br/>
            <input type="submit" value="Envoyer l'email de vérification">
        </form>
    </section>

    <!--<section class="b-darken">
        <h3>Rejoindre une classe</h3>

        <?php
/*            require 'db.php';
            $classes = $db->query('SELECT * FROM classes');
            // Print classes list
            foreach ($classes as $class) {
                $class_url = strtolower(str_replace(' ', '', $class['name']));
                echo '<a href="'.getRootPath().'todo/class/'.$class_url.'/join" class="btn btn-primary">'.$class['name'].'</a>&nbsp;';
            }
        */?>

    </section>
    <section class="b-darken">
        <h3>Créer une classe</h3>
        <form action="<?php /*= getRootPath() */?>todo/class/add" method="post">
            <label for="class_name">Nom de la classe&#8239;:</label><br/>
            <input type="text" name="class_name" id="class_name" placeholder="1A Groupe 6" required><br/>
            <input type="submit" value="Créer">
        </form>
    </section>-->
</main>
<footer>
    <?= getFooter('<a href="'.getRootPath().'todo/classes">Liste des classes</a>', "Clément GRENNERAT") ?>
</footer>
</body>
</html>