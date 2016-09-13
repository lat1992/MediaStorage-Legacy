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
    <body class="login-page">
        <div class="page-login">
            <div class= "logo" style="background-image: url(ClientBundle/ressources/organization/<?= $_SESSION['id_plateform_organization'] ?>/img/logo.png); background-size: contain;"></div>
            <div class="form">
                <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
                    <input type="text" name="username_mediastorage" id="username_mediastorage" placeholder="<?= USERNAME ?>" />
                    <input type="password" name="password_mediastorage" id="password_mediastorage" placeholder="<?= PASSWORD ?>" />
                    <input type="hidden" name="id_login_mediastorage" value="98374" />
                    <button type="submit"><?= VALIDATE ?></button>
                </form>
            </div>
        </div>
<?php
    if (isset($text['text'])) {
?>
        <div class="page-text">
        <?= $text['text'] ?>
        </div>
<?php
    }
?>
    </body>
</html>