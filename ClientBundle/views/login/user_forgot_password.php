<html>
  <head>
    <meta charset="UTF-8">
    <title>MediaStorage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="ClientBundle/ressources/login/css/style.css" />

    <style>

<?php
            if (isset($designs)) {

                foreach ($designs as $design) {
?>
                    <?= $design['selector'] ?> {
                        <?= $design['property'] ?> : <?= $design['value'] ?>;
                    }
<?php
                }
            }
?>

    </style>

  </head>
    <body>
        <div>
            <h1>Formulaire de demande de mot de passe</h1>
            <form>
                <span>Veuillez remplir votre e-mail :</span>
                <input type="text" name="mail">
                <input type="hidden" name="id_login_mediastorage" value="98374">
                <input type="submit" value="<?= VALIDATE ?>">
            </form>
        </div>
    </body>
</html>