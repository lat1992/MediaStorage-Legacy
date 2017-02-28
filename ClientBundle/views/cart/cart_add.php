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
            <select name="delivery_mode">
            <?php
                if ($mediafile['right_download'] == "1") {
            ?>
                <option value="Download"><?= DOWNLOAD ?></option>
            <?php
                }
            ?>
                <option value="Delivery"><?= DELIVERY ?></option>
            </select>
        </div>
        <div class="clear"></div>
        <div style="margin: auto auto 50px auto">
            <label><?= TRANSCODE_MODE ?></label>
            <select name="workflow_id">
                <option value="NULL"><?= WITHOUT_TRANSCODE ?></option>
            <?php
                while ($wf = $workflows['data']->fetch_assoc()) {
                    echo '<option value="'.$wf['id'].'">'.$wf['name'].'</option>';
                }
            ?>
            </select>
        </div>
        <div class="clear"></div>
        <div style="margin: auto auto 50px auto">
            <label><?= TC_IN.' & '.TC_OUT. ' ('.OPTIONAL.')' ?></label>
            <input name="tc_in" type="text" style="width: 70px"> <input name="tc_out" type="text" style="width: 70px">
        </div>
        <div class="clear"></div>
        <div style="margin: auto auto 50px auto">
            <label><?= COMMENT ?></label>
            <input name="comment" type="textarea" rows="2">
        </div>
        <div class="clear"></div>



        <input type="hidden" name="id_cart_validate_mediastorage" value="86452312">
        <a class="button button-delete" style="padding: 2px 20px 0px 20px; margin: auto 10px" href="?page=content&media_id=<?= $_GET['original_id'] ?>"><?= CANCEL ?></a>
        <a class="button button-validate margin-left margin-top" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>
    </form>
</div>
<script>

</script>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
