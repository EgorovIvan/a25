<?php

require_once 'sdbh.php';
$dbh = new sdbh();

$services = unserialize($dbh->mselect_rows('a25_settings', ['set_key' => 'services'], 0, 1, 'id')[0]['set_value']);
$i = 0;
foreach ($services as $k => $s) { ?>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="checkedList[]" value="<?= $s ?>" id="flexCheckChecked<?= $i ?>"
        >
        <label class="form-check-label" for="flexCheckChecked<?= $i ?>">
            <?= $k ?> - <?= $s ?> ₽
        </label>
    </div>
    <?
    $i++;
}
?>