<?php

require_once('ClientBundle/views/layout/header.php');

?>

<!-- <link rel="stylesheet" href="ClientBundle/ressources/folder/css/folder.css">

<script src="ClientBundle/ressources/folder/js/folder.js"></script>
 -->

<style>
    #container {
        width: 90%;
        margin: auto;
        text-align: center;
    }

    label {
        display: inline-block;
        float: left;
        width: 50%;
        text-align: right;
        margin: 10px 0 0 5px;
    }

    input, select {
        float: left;
        display: inline-block;
        text-align: left;
        margin: 10px 0 10px 15px;
        border-style: none;
        font-size: 0.9em;
        padding: 3px;
    }

    input.submit {
        float: none;
    }

    .clear {
        clear: both;
    }

    form {
        margin-top: 15px;
    }

    #cancel_button {
        font-size: 0.9em;
        padding: 6px 10px 6px 10px;
        margin: 30px 0 0 70px;
        width: 100px;
    }

    #validate_button {
        padding: 7px 12px 7px 12px;
        margin: 30px 0 0 10px;
        width: 130px;
    }

    .form_button {
        text-decoration: none;
        display: inline-block;
        background-color: red;
        color: white;
        font-weight: bold;
        font-family: 'roboto', 'Quicksand';
        background-color: #404040;
        text-align: center;
    }

    #cancel_button:hover {
        background-color: #b30000;
        color: white;
    }

    #validate_button:hover {
        background-color: #FED500;
        color: black;
    }

@media only screen and (max-width: 500px) {
    input, select {
        width: 100%;
        margin: 10px 0 0 0;
    }

    label {
        width: 100%;
        text-align: left;
    }

    .form_button {
    }

    #cancel_button {
        width: 40%;
        float: left;
        margin: 20px 0 0 0 ;
    }

    #validate_button {
        width: 40%;
        float: right;
        margin: 20px 0 0 0 ;
        padding: 7px 12px 6px 12px;
    }

}

</style>

<div id="container">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
        <label for="username_mediastorage"><?= USERNAME ?> :</label>
        <input type="text" name="username_mediastorage" id="username_mediastorage" value="<?= (isset($user['username'])) ? $user['username'] : '' ?>" /><br />

        <label for="password_mediastorage"><?= PASSWORD ?> :</label>
        <input type="password" name="password_mediastorage" id="password_mediastorage" /><br />

        <label for="password_mediastorage_bis"><?= PASSWORD_BIS ?> :</label>
        <input type="password" name="password_mediastorage_bis" id="password_mediastorage_bis"/><br />

        <label for="id_organization_mediastorage"><?= ORGANIZATION ?> :</label>
        <select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
    <?php
            while ($organization = $organizations['data']->fetch_assoc()) {
                echo '<option value="' . $organization['id'] . '" ' . ((intval($organization['id']) == intval($user['id_organization'])) ? ' selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['name'] . '</option>';
            }
    ?>
        </select>
        <div class="clear"></div>

        <label for="id_role_mediastorage"><?= ROLE ?> :</label>
        <select name="id_role_mediastorage" id="id_role_mediastorage"/>
    <?php
            while ($role = $roles['data']->fetch_assoc()) {
                echo '<option value="' . $role['id'] . '" ' . ((intval($role['id']) == intval($user['id_role'])) ? ' selected' : '') . '>' . $role['role'] . '</option>';
            }
    ?>
        </select>
        <br />

        <label for="id_language_mediastorage"><?= LANGUAGE ?> :</label>
        <select name="id_language_mediastorage" id="id_language_mediastorage"/>
    <?php
            while ($language = $languages['data']->fetch_assoc()) {
                if ($language['id'] != 1) {
                    echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($user['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
                }
            }
    ?>
        </select>
        <br />

        <label for="first_name_mediastorage"><?= FIRST_NAME ?> :</label>
        <input type="text" name="first_name_mediastorage" id="first_name_mediastorage" value="<?= (isset($user['first_name'])) ? $user['first_name'] : '' ?>"/><br />

        <label for="last_name_mediastorage"><?= LAST_NAME ?> :</label>
        <input type="text" name="last_name_mediastorage" id="last_name_mediastorage" value="<?= (isset($user['last_name'])) ? $user['last_name'] : '' ?>"/><br />

        <label for="company_mediastorage"><?= COMPANY ?> :</label>
        <input type="text" name="company_mediastorage" id="company_mediastorage" value="<?= (isset($user['company'])) ? $user['company'] : '' ?>"/><br />

        <label for="job_mediastorage"><?= JOB ?> :</label>
        <input type="text" name="job_mediastorage" id="job_mediastorage" value="<?= (isset($user['job'])) ? $user['job'] : '' ?>"/><br />

        <label for="email_mediastorage"><?= EMAIL ?> :</label>
        <input type="email" name="email_mediastorage" id="email_mediastorage" value="<?= (isset($user['email'])) ? $user['email'] : '' ?>" /><br />

        <label for="address_mediastorage"><?= ADDRESS ?> :</label>
        <input type="text" name="address_mediastorage" id="address_mediastorage" value="<?= (isset($user['address'])) ? $user['address'] : '' ?>"/><br />

        <label for="zipcode_mediastorage"><?= ZIPCODE ?> :</label>
        <input type="text" name="zipcode_mediastorage" id="zipcode_mediastorage" value="<?= (isset($user['zipcode'])) ? $user['zipcode'] : '' ?>"/><br />

        <label for="city_mediastorage"><?= CITY ?> :</label>
        <input type="text" name="city_mediastorage" id="city_mediastorage" value="<?= (isset($user['city'])) ? $user['city'] : '' ?>"/><br />

        <label for="country_mediastorage"><?= COUNTRY ?> :</label>
        <input type="text" name="country_mediastorage" id="country_mediastorage" value="<?= (isset($user['country'])) ? $user['country'] : '' ?>"/><br />

        <label for="phone_mediastorage"><?= PHONE ?> :</label>
        <input type="tel" name="phone_mediastorage" id="phone_mediastorage" value="<?= (isset($user['phone'])) ? $user['phone'] : '' ?>"/><br />

        <label for="mobile_mediastorage"><?= MOBILE ?> :</label>
        <input type="tel" name="mobile_mediastorage" id="mobile_mediastorage" value="<?= (isset($user['mobile'])) ? $user['mobile'] : '' ?>"/><br />

        <input type="hidden" name="id_user_create_mediastorage" value="98475" />

        <div class="clear"></div>

        <a id="cancel_button" class="form_button" href="?page=folder">Annuler</a>

        <input id="validate_button" type="submit" class="submit form_button" value="<?= VALIDATE ?>" />
    </form>

</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
