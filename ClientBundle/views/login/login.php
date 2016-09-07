<html>
  <head>
    <meta charset="UTF-8">
    <title>MediaStorage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="ClientBundle/ressources/login/css/style.css" />

    <style>

/*        body {
            background-color: #a6a6a6;
        }

        body {
            color: #000000;
        }

        .form button {
            background-color: #404040;
        }

        .form button {
            color: #d9d9d9;
        }

        .form button:hover,.form button:active,.form button:focus {
            background-color: #FED500;
        }

        .form button:hover,.form button:active,.form button:focus {
            color: #262626;
        }

        .form {
            background-color: #f2f2f2;
        }

        .form {
            color:;
        }*/

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
        <div class="login-page">
            <div class= "logo" style="background-image: url(https://pbs.twimg.com/profile_images/1179925665/media365_400.jpg)"></div>
            <div class="form">
                <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
                    <input type="text" name="username_mediastorage" id="username_mediastorage" placeholder="<?= USERNAME ?>" />
                    <input type="password" name="password_mediastorage" id="password_mediastorage" placeholder="<?= PASSWORD ?>" />
                    <input type="hidden" name="id_login_mediastorage" value="98374" />
                    <button type="submit"><?= VALIDATE ?></button>
                </form>
            </div>
        </div>
        <script>
            $('.message a').click(function(){
                $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
            });
        </script>
    </body>
</html>