<html>
  <head>
    <meta charset="UTF-8">
    <title>MediaStorage</title>
    <link rel="stylesheet" type="text/css" href="ClientBundle/ressources/login/css/style.css" />
    <script src="js/prefixfree.min.js"></script>
  </head>

  <body>
    <div class="login-form">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
        <div class="field">
          <label for="username_mediastorage"><?= USERNAME ?></label>
          <input type="text" name="username_mediastorage" id="username_mediastorage"/>
        </div>
        <div class="field">
          <label for="password_mediastorage"><?= PASSWORD ?></label>
          <input type="password" name="password_mediastorage" id="password_mediastorage"/>
        </div>
        <div class="field">
        <input type="hidden" name="id_login_mediastorage" value="98374" />
        <input type="submit" value="<?= VALIDATE ?>" />
        </div>
      </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  </body>
</html>