<html>
  <head>
    <meta charset="UTF-8">
    <title>MediaStorage</title>
    <link rel="stylesheet" type="text/css" href="ClientBundle/ressources/login/css/style.css" />
  </head>

  <body>

    <div class="login-page">
        <div class= "logo" style='background-image: url(https://pbs.twimg.com/profile_images/1179925665/media365_400.jpg)'></div>
      <div class="form">
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
          <input type="text" name="username_mediastorage" id="username_mediastorage" placeholder="<?= USERNAME ?>"/>
          <input type="password" name="password_mediastorage" id="password_mediastorage" placeholder="<?= PASSWORD ?>"/>
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