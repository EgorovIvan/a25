<?php

if (empty($_POST)) {
    exit;
}

require_once 'sdbh.php';
$dbh = new sdbh();

if (isset($_POST['product']) && $_POST['product']) {
    $nameProduct = htmlspecialchars($_POST['product']);
    $price = $dbh->mselect_rows('a25_products', ['NAME' => $nameProduct], 0, 1, 'id')[0]['PRICE'];
    $tariff = $dbh->mselect_rows('a25_products', ['NAME' => $nameProduct], 0, 1, 'id')[0]['TARIFF'];

    if (isset($tariff)) {
        $rates = unserialize($tariff);
    }
}



if (isset($rates)) {
    $arrayKeys = array_keys($rates);
    foreach ($rates as $key => $rate) {
        $mode = next($arrayKeys);
        if ($rate == reset($rates)) {?>
            <li>до <?= $mode; ?> суток: <strong><?= $rate; ?> рублей/сутки</strong></li>
        <? } elseif ($rate == end($rates)) { ?>
            <li>от <?= $key ?> суток: <strong><?= $rate; ?> рублей/сутки</strong></li>
        <? } else { ?>
            <li>от <?= $key; ?> до <?= $mode; ?> суток: <strong><?= $rate; ?> рублей/сутки</strong></li>
        <? }
    }
} elseif (empty($tariff) && isset($price)) { ?>
    <li><?= $price ?> рублей/сутки</li>
<? }
?>

