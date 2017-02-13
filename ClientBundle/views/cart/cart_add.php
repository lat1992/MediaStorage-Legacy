<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">
<link rel="stylesheet" href="ClientBundle/ressources/content/css/button.css">

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
<div id="container">
    <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
        <div style="margin: 50px auto auto auto">
            <label><?= DELIVERY_MODE ?></label>
            <select name="selection">
                <option><?= CHOSE ?></option>
            <?php
                $row = $media_file_data['data']->fetch_assoc();
                if (strcmp($row['type'], 'MASTER') !== 0) {
            ?>
                <option value="download"><?= DOWNLOAD ?></option>
            <?php
                }
            ?>
                <option value="delivery"><?= DELIVERY ?></option>
            </select>
        </div>
        <div class="clear"></div>
        <div style="margin: auto auto 50px auto">
            <label><?= TRANSCODE_MODE ?></label>
            <select name="selection">
                <option><?= WITHOUT_TRANSCODE ?></option>
            </select>
        </div>
        <div class="clear"></div>
        <input type="hidden" id="id_cart_validate_mediastorage" value="86452312">
        <div style="margin: 50px auto">
            <a class="button button-delete" style="padding: 2px 20px 0px 20px; margin: auto 10px" href="?page=content&media_id=<?= $_GET['original_id'] ?>"><?= CANCEL ?></a>
            <button class="button button-validate" style="margin: auto 10px" type="submit"><?= VALIDATE ?></button>
        </div>
    </form>
</div>
<script>

</script>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
